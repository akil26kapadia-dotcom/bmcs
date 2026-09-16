<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index(Request $request): void
    {
        $db = Database::connection();

        $this->view('pages/admin/dashboard', [
            'title' => 'Dashboard',
            'total_posts' => (int) $db->query('SELECT COUNT(*) FROM posts')->fetchColumn(),
            'published_posts' => (int) $db->query("SELECT COUNT(*) FROM posts WHERE status = 'published'")->fetchColumn(),
            'draft_posts' => (int) $db->query("SELECT COUNT(*) FROM posts WHERE status = 'draft'")->fetchColumn(),
            'total_categories' => (int) $db->query('SELECT COUNT(*) FROM categories')->fetchColumn(),
            'recent_posts' => array_slice(Post::adminAll(), 0, 5),
        ], 'layouts/admin');
    }
}
