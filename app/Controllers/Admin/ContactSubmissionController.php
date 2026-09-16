<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Models\ContactSubmission;

class ContactSubmissionController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/admin/contacts/index', [
            'title' => 'Contact Submissions',
            'submissions' => ContactSubmission::all('id DESC'),
        ], 'layouts/admin');
    }

    public function markRead(Request $request, array $params): void
    {
        ContactSubmission::update((int) $params['id'], ['status' => 'read']);
        $this->redirect('/admin/contacts');
    }
}
