<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(ContactFormRequest $request)
    {
        try {
            // Send email
            Mail::to(config('mail.contact_email', 'contact@mywebsite.com'))
                ->send(new ContactFormMail($request->validated()));

            return redirect()
                ->route('contact.index')
                ->with('success', 'Thank you for your message! We\'ll get back to you soon.');
        } catch (\Exception $e) {
            return redirect()
                ->route('contact.index')
                ->with('error', 'Sorry, there was an error sending your message. Please try again.')
                ->withInput();
        }
    }
}
