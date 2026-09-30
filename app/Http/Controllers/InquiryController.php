<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\Inquiry;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\RedirectResponse;

class InquiryController extends Controller
{
    public function store(StoreInquiryRequest $request): RedirectResponse
    {
        $limiter = new RateLimiter(app('cache')->store('file'));
        $key = 'academy-inquiry:'.hash('sha256', (string) $request->ip());

        if ($limiter->tooManyAttempts($key, 5)) {
            return redirect()->to(route('free-class'))
                ->withErrors(['inquiry' => 'You have sent several inquiries. Please try again in an hour, or call us directly.'])
                ->withInput();
        }

        Inquiry::create($request->safe()->only([
            'parent_name', 'child_name', 'class', 'child_age', 'phone', 'interested_in', 'message',
        ]));

        $limiter->hit($key, 3600);

        return redirect()->to(route('free-class'))
            ->with('inquiry_success', 'Thank you! Your free-class request has been received. We will contact you to discuss a suitable time.');
    }
}
