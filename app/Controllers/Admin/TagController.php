<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Helpers\Str;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/admin/tags/index', [
            'title' => 'Tags',
            'tags' => Tag::all('name ASC'),
        ], 'layouts/admin');
    }

    public function store(Request $request): void
    {
        $name = trim((string) $request->input('name', ''));

        if ($name === '') {
            Session::flash('admin_error', 'Tag name is required.');
            $this->redirect('/admin/tags');
            return;
        }

        Tag::create([
            'name' => $name,
            'slug' => Str::slug($request->input('slug') ?: $name),
        ]);

        Session::flash('admin_success', 'Tag created.');
        $this->redirect('/admin/tags');
    }

    public function delete(Request $request, array $params): void
    {
        Tag::delete((int) $params['id']);
        Session::flash('admin_success', 'Tag deleted.');
        $this->redirect('/admin/tags');
    }
}
