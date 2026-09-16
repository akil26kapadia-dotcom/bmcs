<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Request;
use App\Core\Session;
use App\Helpers\FileUpload;
use App\Helpers\Str;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    private const UPLOAD_DIR = __DIR__ . '/../../../public/uploads';

    public function index(Request $request): void
    {
        $this->view('pages/admin/posts/index', [
            'title' => 'Posts',
            'posts' => Post::adminAll(),
        ], 'layouts/admin');
    }

    public function create(Request $request): void
    {
        $this->view('pages/admin/posts/form', [
            'title' => 'New Post',
            'post' => null,
            'selectedTagIds' => [],
            'categories' => Category::all('name ASC'),
            'tags' => Tag::all('name ASC'),
        ], 'layouts/admin');
    }

    public function store(Request $request): void
    {
        $title = trim((string) $request->input('title', ''));

        if ($title === '') {
            Session::flash('admin_error', 'Title is required.');
            $this->redirect('/admin/posts/create');
            return;
        }

        $data = $this->extractPostData($request, $title);
        $data['author_id'] = Session::get('admin_id');
        $data['slug'] = $this->uniqueSlug($data['slug']);

        if ($featuredImage = $this->handleFeaturedImageUpload($request)) {
            $data['featured_image'] = $featuredImage;
        }

        $id = Post::create($data);
        Post::syncTags($id, $request->input('tag_ids', []) ?: []);

        Session::flash('admin_success', 'Post created.');
        $this->redirect('/admin/posts/edit/' . $id);
    }

    public function edit(Request $request, array $params): void
    {
        $post = Post::find((int) $params['id']);

        if ($post === null) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Post Not Found']);
            return;
        }

        $selectedTagIds = array_column(Post::tagsForPost((int) $post['id']), 'id');

        $this->view('pages/admin/posts/form', [
            'title' => 'Edit Post',
            'post' => $post,
            'selectedTagIds' => $selectedTagIds,
            'categories' => Category::all('name ASC'),
            'tags' => Tag::all('name ASC'),
        ], 'layouts/admin');
    }

    public function update(Request $request, array $params): void
    {
        $id = (int) $params['id'];
        $existing = Post::find($id);

        if ($existing === null) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Post Not Found']);
            return;
        }

        $title = trim((string) $request->input('title', ''));

        if ($title === '') {
            Session::flash('admin_error', 'Title is required.');
            $this->redirect('/admin/posts/edit/' . $id);
            return;
        }

        $data = $this->extractPostData($request, $title);
        $data['slug'] = $this->uniqueSlug($data['slug'], $id);

        if ($featuredImage = $this->handleFeaturedImageUpload($request)) {
            $data['featured_image'] = $featuredImage;
        }

        Post::update($id, $data);
        Post::syncTags($id, $request->input('tag_ids', []) ?: []);

        Session::flash('admin_success', 'Post updated.');
        $this->redirect('/admin/posts/edit/' . $id);
    }

    public function delete(Request $request, array $params): void
    {
        Post::delete((int) $params['id']);
        Session::flash('admin_success', 'Post deleted.');
        $this->redirect('/admin/posts');
    }

    /** Shared field extraction/validation for store() and update(). */
    private function extractPostData(Request $request, string $title): array
    {
        $status = in_array($request->input('status'), ['draft', 'published', 'scheduled'], true)
            ? $request->input('status')
            : 'draft';

        $publishedAt = trim((string) $request->input('published_at', ''));
        if ($publishedAt !== '') {
            $publishedAt = date('Y-m-d H:i:s', strtotime($publishedAt));
        } elseif ($status === 'published') {
            $publishedAt = date('Y-m-d H:i:s');
        } elseif ($status === 'scheduled') {
            $publishedAt = date('Y-m-d H:i:s', strtotime('+1 hour'));
        } else {
            $publishedAt = null;
        }

        return [
            'title' => $title,
            'slug' => Str::slug($request->input('slug') ?: $title),
            'excerpt' => trim((string) $request->input('excerpt', '')) ?: null,
            'content' => (string) $request->input('content', ''),
            'category_id' => $request->input('category_id') ?: null,
            'status' => $status,
            'is_featured' => $request->input('is_featured') ? 1 : 0,
            'published_at' => $publishedAt,
            'meta_title' => trim((string) $request->input('meta_title', '')) ?: null,
            'meta_description' => trim((string) $request->input('meta_description', '')) ?: null,
            'meta_keywords' => trim((string) $request->input('meta_keywords', '')) ?: null,
            'canonical_url' => trim((string) $request->input('canonical_url', '')) ?: null,
            'og_title' => trim((string) $request->input('og_title', '')) ?: null,
            'og_description' => trim((string) $request->input('og_description', '')) ?: null,
            'og_image' => trim((string) $request->input('og_image', '')) ?: null,
        ];
    }

    private function handleFeaturedImageUpload(Request $request): ?string
    {
        $file = $_FILES['featured_image'] ?? null;

        if ($file === null || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        $errors = FileUpload::validate($file);
        if (!empty($errors)) {
            Session::flash('admin_error', implode(' ', $errors));
            return null;
        }

        $filename = FileUpload::store($file, self::UPLOAD_DIR);
        return '/uploads/' . $filename;
    }

    /** Appends -2, -3, etc. until the slug is unique (excluding the post being edited). */
    private function uniqueSlug(string $slug, ?int $excludeId = null): string
    {
        $db = Database::connection();
        $base = $slug;
        $suffix = 2;

        while (true) {
            $stmt = $db->prepare('SELECT id FROM posts WHERE slug = :slug' . ($excludeId ? ' AND id != :id' : ''));
            $params = ['slug' => $slug];
            if ($excludeId) {
                $params['id'] = $excludeId;
            }
            $stmt->execute($params);

            if ($stmt->fetch() === false) {
                return $slug;
            }

            $slug = $base . '-' . $suffix;
            $suffix++;
        }
    }
}
