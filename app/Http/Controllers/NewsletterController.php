<?php

namespace App\Http\Controllers;

use App\Services\INewsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __invoke(INewsletter $newsletter)
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email adress could not be added to our newsletter list.'
            ]);
        }
    
        
        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter.');
    }
}
