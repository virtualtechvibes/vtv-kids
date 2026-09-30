<?php

namespace Tests\Feature;

use Tests\TestCase;

class FreeClassTest extends TestCase
{
    public function test_free_class_page_has_a_working_form_and_three_steps(): void
    {
        $this->get(route('free-class'))->assertOk()
            ->assertSee('Let’s get started.')
            ->assertSee(route('inquiries.store'), false)
            ->assertSee('data-step="0"', false)
            ->assertSee('data-step="1"', false)
            ->assertSee('data-step="2"', false)
            ->assertSee('name="_token"', false)
            ->assertSee('Request my free class');
    }

    public function test_program_choice_is_preselected_from_landing_page(): void
    {
        $this->get(route('free-class', ['program' => 'AI']))
            ->assertSee('value="AI" required checked', false);
    }

    public function test_unknown_program_query_defaults_to_tuition(): void
    {
        $this->get(route('free-class', ['program' => '<script>alert(1)</script>']))
            ->assertSee('value="Tuition" required checked', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_success_state_confirms_request_without_claiming_a_booking(): void
    {
        $this->withSession(['inquiry_success' => 'Your request has been received.'])
            ->get(route('free-class'))->assertSee('Your free-class request is in!')
            ->assertSee('confirm a suitable class time')
            ->assertDontSee('data-booking-form', false);
    }

    public function test_validation_redirects_to_free_class_page_with_old_input(): void
    {
        $this->post(route('inquiries.store'), ['parent_name' => 'Parent Example'])
            ->assertRedirect(route('free-class'))
            ->assertSessionHasInput('parent_name', 'Parent Example')
            ->assertSessionHasErrors('phone');
    }

    public function test_landing_page_uses_free_class_ctas_and_original_logo(): void
    {
        $this->get(route('home'))->assertSee('Try a free class')
            ->assertSee(route('free-class'), false)
            ->assertSee('images/vtv-logo.webp', false)
            ->assertDontSee('Book a Free Demo')
            ->assertDontSee('Book Free Demo')
            ->assertSee('0120-4033740')
            ->assertSee('tel:+911204033740', false)
            ->assertDontSee('wa.me', false)
            ->assertDontSee('WhatsApp');
    }
}
