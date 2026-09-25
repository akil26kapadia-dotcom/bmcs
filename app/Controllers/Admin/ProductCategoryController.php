<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Helpers\Str;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/admin/products/index', [
            'title' => 'Product Categories',
            'categories' => ProductCategory::allOrdered(),
        ], 'layouts/admin');
    }

    public function store(Request $request): void
    {
        $name = trim((string) $request->input('name', ''));

        if ($name === '') {
            Session::flash('admin_error', 'Category name is required.');
            $this->redirect('/admin/products');
            return;
        }

        ProductCategory::create([
            'name' => $name,
            'slug' => Str::slug($request->input('slug') ?: $name),
            'icon' => trim((string) $request->input('icon', '')) ?: 'layers',
            'description' => trim((string) $request->input('description', '')) ?: null,
            'sort_order' => (int) $request->input('sort_order', 100),
        ]);

        Session::flash('admin_success', 'Product category added.');
        $this->redirect('/admin/products');
    }

    public function delete(Request $request, array $params): void
    {
        ProductCategory::delete((int) $params['id']);
        Session::flash('admin_success', 'Product category deleted.');
        $this->redirect('/admin/products');
    }
}
