<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Helpers\FileUpload;
use App\Helpers\Str;
use App\Models\Media;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    private const UPLOAD_DIR = __DIR__ . '/../../../public/uploads';

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
            'icon' => $this->resolveIcon($request, 'icon', 'layers'),
            'description' => trim((string) $request->input('description', '')) ?: null,
            'sort_order' => (int) $request->input('sort_order', 100),
        ]);

        Session::flash('admin_success', 'Product category added.');
        $this->redirect('/admin/products');
    }

    public function update(Request $request, array $params): void
    {
        $id = (int) $params['id'];
        $name = trim((string) $request->input('name', ''));

        if ($name === '') {
            Session::flash('admin_error', 'Category name is required.');
            $this->redirect('/admin/products');
            return;
        }

        ProductCategory::update($id, [
            'name' => $name,
            'icon' => $this->resolveIcon($request, 'icon', 'layers'),
            'description' => trim((string) $request->input('description', '')) ?: null,
            'sort_order' => (int) $request->input('sort_order', 100),
        ]);

        Session::flash('admin_success', 'Product category updated.');
        $this->redirect('/admin/products');
    }

    public function delete(Request $request, array $params): void
    {
        ProductCategory::delete((int) $params['id']);
        Session::flash('admin_success', 'Product category deleted.');
        $this->redirect('/admin/products');
    }

    /**
     * The icon field accepts either a typed built-in icon name or an
     * uploaded custom image (Icon::svg() renders whichever it finds) — an
     * uploaded file wins over a typed name.
     */
    private function resolveIcon(Request $request, string $field, string $default): string
    {
        $file = $_FILES[$field . '_file'] ?? null;
        if ($file !== null && ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            $errors = FileUpload::validate($file);
            if (empty($errors)) {
                $filename = FileUpload::store($file, self::UPLOAD_DIR);
                $path = '/uploads/' . $filename;

                Media::create([
                    'file_name' => $filename,
                    'file_path' => $path,
                    'mime_type' => mime_content_type(self::UPLOAD_DIR . '/' . $filename),
                    'size_bytes' => filesize(self::UPLOAD_DIR . '/' . $filename),
                    'alt_text' => null,
                    'uploaded_by' => Session::get('admin_id'),
                ]);

                return $path;
            }
            Session::flash('admin_error', implode(' ', $errors));
        }

        return trim((string) $request->input($field, '')) ?: $default;
    }
}
