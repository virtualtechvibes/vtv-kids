<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['cache.stores.file' => ['driver' => 'array']]);
    }

    /** @return array<string, mixed> */
    private function inquiry(array $overrides = []): array
    {
        return array_replace([
            'parent_name' => 'Demo Parent',
            'child_name' => 'Demo Child',
            'class' => 3,
            'child_age' => 8,
            'phone' => '9876543210',
            'interested_in' => 'Tuition + AI',
            'message' => 'Please discuss an afternoon demo.',
            'consent' => '1',
        ], $overrides);
    }

    public function test_valid_inquiry_is_saved_and_parent_sees_confirmation(): void
    {
        $response = $this->post(route('inquiries.store'), $this->inquiry(['id' => 999]));

        $response->assertRedirect(route('free-class'))->assertSessionHas('inquiry_success');
        $this->assertDatabaseHas('inquiries', [
            'parent_name' => 'Demo Parent', 'child_name' => 'Demo Child',
            'class' => 3, 'child_age' => 8, 'phone' => '9876543210',
            'interested_in' => 'Tuition + AI', 'message' => 'Please discuss an afternoon demo.',
        ]);
        $this->assertDatabaseMissing('inquiries', ['id' => 999]);
        $this->assertDatabaseCount('inquiries', 1);
    }

    public function test_prep_tuition_request_is_saved_and_prep_is_offered_in_the_form(): void
    {
        $this->post(route('inquiries.store'), $this->inquiry([
            'class' => 0, 'child_age' => 4, 'interested_in' => 'Tuition',
        ]))->assertSessionHasNoErrors()->assertSessionHas('inquiry_success');

        $this->assertDatabaseHas('inquiries', ['class' => 0, 'child_age' => 4, 'interested_in' => 'Tuition']);
        $this->withSession(['_old_input' => ['class' => '0'], 'inquiry_success' => null])
            ->get(route('free-class'))->assertSee('value="0" selected>Prep', false);
    }

    public function test_tuition_is_available_to_children_under_seven(): void
    {
        $this->post(route('inquiries.store'), $this->inquiry([
            'child_age' => 6, 'class' => 1, 'interested_in' => 'Tuition', 'message' => null,
        ]))->assertSessionHasNoErrors()->assertSessionHas('inquiry_success');

        $this->assertDatabaseHas('inquiries', ['child_age' => 6, 'interested_in' => 'Tuition']);
    }

    public function test_ai_accepts_age_seven_and_international_phone_prefix(): void
    {
        $this->post(route('inquiries.store'), $this->inquiry([
            'child_age' => 7, 'interested_in' => 'AI', 'phone' => '+91 9876543210',
        ]))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('inquiries', ['child_age' => 7, 'phone' => '+91 9876543210']);
    }

    public function test_missing_required_fields_do_not_create_an_inquiry(): void
    {
        $this->post(route('inquiries.store'), [])->assertSessionHasErrors([
            'parent_name', 'child_name', 'class', 'child_age', 'phone', 'interested_in', 'consent',
        ]);

        $this->assertDatabaseCount('inquiries', 0);
    }

    /** @return array<string, array{array<string, mixed>, string}> */
    public static function invalidInquiries(): array
    {
        return [
            'AI age restriction' => [['interested_in' => 'AI', 'child_age' => 6], 'child_age'],
            'combined age restriction' => [['child_age' => 6], 'child_age'],
            'invalid phone' => [['phone' => '123'], 'phone'],
            'unknown program' => [['interested_in' => 'Other'], 'interested_in'],
            'class below Prep' => [['class' => -1], 'class'],
            'class outside tuition' => [['class' => 9], 'class'],
            'age not numeric' => [['child_age' => 'eight'], 'child_age'],
            'invalid age' => [['child_age' => 0], 'child_age'],
            'age exceeds maximum' => [['child_age' => 19], 'child_age'],
            'no consent' => [['consent' => '0'], 'consent'],
            'bot field filled' => [['website' => 'spam.example'], 'website'],
            'parent name too long' => [['parent_name' => str_repeat('a', 101)], 'parent_name'],
            'child name too long' => [['child_name' => str_repeat('a', 101)], 'child_name'],
            'message too long' => [['message' => str_repeat('a', 2001)], 'message'],
        ];
    }

    #[DataProvider('invalidInquiries')]
    public function test_invalid_inquiry_is_rejected_without_saving(array $overrides, string $field): void
    {
        $response = $this->post(route('inquiries.store'), $this->inquiry($overrides));

        $response->assertSessionHasErrors($field);
        $this->assertDatabaseCount('inquiries', 0);
    }

    public function test_ai_age_error_explains_tuition_is_still_available(): void
    {
        $this->post(route('inquiries.store'), $this->inquiry(['child_age' => 6]))
            ->assertSessionHasErrors(['child_age' => 'The AI program starts at age 7. You can choose Tuition for younger children.']);
    }

    public function test_sixth_request_is_limited_without_saving(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('inquiries.store'), $this->inquiry())->assertSessionHasNoErrors();
        }

        $this->post(route('inquiries.store'), $this->inquiry())
            ->assertRedirect(route('free-class'))->assertSessionHasErrors('inquiry');

        $this->assertDatabaseCount('inquiries', 5);
    }

    public function test_form_escapes_previous_input(): void
    {
        $this->withSession(['_old_input' => ['parent_name' => '<script>alert(1)</script>']])
            ->get(route('free-class'))
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_landing_page_and_privacy_notice_are_available(): void
    {
        $this->get(route('home'))->assertSee('Tuition available for Prep to Class 8')
            ->assertSee('AI Program for Kids')->assertSee('Age 7+');
        $this->get(route('privacy'))->assertOk()->assertSee('Inquiry privacy notice');
    }
}
