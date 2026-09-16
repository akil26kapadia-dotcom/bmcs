<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\ContactSubmission;

class ContactController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/contact', [
            'title' => 'Contact Us',
            'description' => 'Get in touch with Bright Mind Computer Solutions (BMCS) for IT infrastructure, networking, security, cloud and digital solutions in Dubai and the UAE.',
        ]);
    }

    public function submit(Request $request): void
    {
        // Honeypot: a hidden field real visitors never fill in.
        if ($request->input('website', '') !== '') {
            $this->redirect('/contact');
            return;
        }

        $data = [
            'name' => trim((string) $request->input('name', '')),
            'email' => trim((string) $request->input('email', '')),
            'phone' => trim((string) $request->input('phone', '')) ?: null,
            'company' => trim((string) $request->input('company', '')) ?: null,
            'service' => trim((string) $request->input('service', '')) ?: null,
            'message' => trim((string) $request->input('message', '')),
        ];

        $errors = $this->validate($data);

        if (!empty($errors)) {
            Session::flash('contact_errors', implode(' ', $errors));
            $this->redirect('/contact');
            return;
        }

        ContactSubmission::create([
            ...$data,
            'ip_address' => $request->ip(),
        ]);

        Session::flash('contact_success', 'Thank you — your message has been received. We will get back to you shortly.');
        $this->redirect('/contact');
    }

    private function validate(array $data): array
    {
        $errors = [];

        if ($data['name'] === '') {
            $errors[] = 'Name is required.';
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email is required.';
        }

        if ($data['message'] === '') {
            $errors[] = 'Message is required.';
        }

        return $errors;
    }
}
