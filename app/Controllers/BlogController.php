<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Helpers\SEO;
use App\Helpers\Url;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller
{
    private const PER_PAGE = 9;

    public function index(Request $request): void
    {
        $this->renderListing($request, []);
    }

    public function category(Request $request, array $params): void
    {
        $category = Category::findBySlug($params['slug']);

        if ($category === null) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Category Not Found']);
            return;
        }

        $this->renderListing($request, ['category' => $params['slug']], [
            'label' => $category['name'],
            'type' => 'category',
        ]);
    }

    public function tag(Request $request, array $params): void
    {
        $tag = Tag::findBySlug($params['slug']);

        if ($tag === null) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Tag Not Found']);
            return;
        }

        $this->renderListing($request, ['tag' => $params['slug']], [
            'label' => $tag['name'],
            'type' => 'tag',
        ]);
    }

    public function show(Request $request, array $params): void
    {
        $post = Post::publishedBySlug($params['slug']);

        if ($post === null) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Article Not Found']);
            return;
        }

        $related = Post::relatedTo(
            $post['category_id'] ? (int) $post['category_id'] : null,
            (int) $post['id']
        );

        $url = Url::full('blog/' . $post['slug']);

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post['title'],
            'description' => $post['meta_description'] ?: $post['excerpt'],
            'datePublished' => date('c', strtotime($post['published_at'])),
            'dateModified' => date('c', strtotime($post['updated_at'])),
            'author' => ['@type' => 'Person', 'name' => $post['author_name'] ?? 'Bright Mind Computer Solutions'],
            'publisher' => ['@type' => 'Organization', 'name' => 'Bright Mind Computer Solutions'],
            'mainEntityOfPage' => $url,
        ];
        if (!empty($post['featured_image'])) {
            $schema['image'] = Url::full($post['featured_image']);
        }

        $this->view('pages/blog/show', [
            'title' => $post['meta_title'] ?: $post['title'],
            'description' => $post['meta_description'] ?: $post['excerpt'],
            'ogTitle' => $post['og_title'] ?: ($post['meta_title'] ?: $post['title']),
            'ogDescription' => $post['og_description'] ?: ($post['meta_description'] ?: $post['excerpt']),
            'ogImage' => $post['og_image'] ?: $post['featured_image'],
            'ogType' => 'article',
            'canonicalOverride' => $post['canonical_url'] ?: null,
            'post' => $post,
            'related' => $related,
            'schema' => $schema,
        ]);
    }

    private function renderListing(Request $request, array $filters, ?array $activeFilter = null): void
    {
        $page = max(1, (int) $request->query('page', 1));
        $search = trim((string) $request->query('q', ''));

        if ($search !== '') {
            $filters['search'] = $search;
        }

        $result = Post::paginate($filters, $page, self::PER_PAGE);

        $heading = 'Blog';
        if ($activeFilter) {
            $heading = $activeFilter['label'];
        } elseif ($search !== '') {
            $heading = 'Search: ' . $search;
        }

        $this->view('pages/blog/index', [
            'title' => $heading === 'Blog' ? 'Blog' : $heading . ' | Blog',
            'description' => 'Technology insights and updates from BMCS covering IT infrastructure, networking, security, cloud and digital solutions.',
            'heading' => $heading,
            'posts' => $result['items'],
            'pagination' => $result,
            'search' => $search,
            'categories' => Category::all('name ASC'),
            'tags' => Tag::all('name ASC'),
            'activeFilter' => $activeFilter,
        ]);
    }
}
