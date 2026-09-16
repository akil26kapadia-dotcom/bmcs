<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Helpers\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/admin/categories/index', [
            'title' => 'Categories',
            'categories' => Category::all('name ASC'),
        ], 'layouts/admin');
    }

    public function store(Request $request): void
    {
        $name = trim((string) $request->input('name', ''));

        if ($name === '') {
            Session::flash('admin_error', 'Category name is required.');
            $this->redirect('/admin/categories');
            return;
        }

        Category::create([
            'name' => $name,
            'slug' => Str::slug($request->input('slug') ?: $name),
            'description' => trim((string) $request->input('description', '')) ?: null,
        ]);

        Session::flash('admin_success', 'Category created.');
        $this->redirect('/admin/categories');
    }

    public function delete(Request $request, array $params): void
    {
        Category::delete((int) $params['id']);
        Session::flash('admin_success', 'Category deleted.');
        $this->redirect('/admin/categories');
    }
}
