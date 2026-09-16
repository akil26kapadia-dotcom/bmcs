<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Helpers\FileUpload;
use App\Models\Media;

class MediaController extends Controller
{
    private const UPLOAD_DIR = __DIR__ . '/../../../public/uploads';

    public function index(Request $request): void
    {
        $this->view('pages/admin/media/index', [
            'title' => 'Media',
            'media' => Media::all(),
        ], 'layouts/admin');
    }

    public function upload(Request $request): void
    {
        $file = $_FILES['file'] ?? null;

        if ($file === null || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            Session::flash('admin_error', 'No file was uploaded.');
            $this->redirect('/admin/media');
            return;
        }

        $errors = FileUpload::validate($file);

        if (!empty($errors)) {
            Session::flash('admin_error', implode(' ', $errors));
            $this->redirect('/admin/media');
            return;
        }

        $filename = FileUpload::store($file, self::UPLOAD_DIR);

        Media::create([
            'file_name' => $filename,
            'file_path' => '/uploads/' . $filename,
            'mime_type' => mime_content_type(self::UPLOAD_DIR . '/' . $filename),
            'size_bytes' => filesize(self::UPLOAD_DIR . '/' . $filename),
            'alt_text' => trim((string) $request->input('alt_text', '')) ?: null,
            'uploaded_by' => Session::get('admin_id'),
        ]);

        Session::flash('admin_success', 'File uploaded.');
        $this->redirect('/admin/media');
    }

    public function delete(Request $request, array $params): void
    {
        $item = Media::find((int) $params['id']);

        if ($item !== null) {
            $path = self::UPLOAD_DIR . '/' . basename($item['file_name']);
            if (is_file($path)) {
                unlink($path);
            }
            Media::delete((int) $params['id']);
        }

        Session::flash('admin_success', 'File deleted.');
        $this->redirect('/admin/media');
    }
}
