<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\SeoMetadata;

class SeoController extends Controller
{
    /**
     * The site's static/listing pages, keyed the same way base.php derives
     * $currentPath (empty path -> 'home'). A per-service, per-post or
     * per-portfolio page is not listed here — those already have their own
     * meta title/description fields on the item itself in their own admin
     * screens, which is the more natural place to edit them.
     */
    private const KNOWN_ROUTES = [
        'home' => 'Homepage (/)',
        'about' => 'About (/about)',
        'services' => 'Services index (/services)',
        'solutions' => 'Solutions We Deliver (/solutions)',
        'solutions/tally-solutions' => 'Tally Solutions (/solutions/tally-solutions)',
        'products' => 'Products (/products)',
        'portfolio' => 'Portfolio (/portfolio)',
        'blog' => 'Blog (/blog)',
        'contact' => 'Contact (/contact)',
    ];

    public function index(Request $request): void
    {
        $existing = SeoMetadata::allAsMap();

        $rows = [];
        foreach (self::KNOWN_ROUTES as $routeKey => $label) {
            $rows[$routeKey] = array_merge(
                ['route_key' => $routeKey, 'label' => $label, 'meta_title' => '', 'meta_description' => '', 'canonical_url' => '', 'og_title' => '', 'og_description' => '', 'og_image' => ''],
                $existing[$routeKey] ?? []
            );
            unset($existing[$routeKey]);
        }

        // Anything left in $existing is a custom route someone added via the
        // form below (e.g. a specific blog category page) — show it too.
        foreach ($existing as $routeKey => $row) {
            $rows[$routeKey] = array_merge(['label' => $routeKey], $row);
        }

        $this->view('pages/admin/seo/index', [
            'title' => 'SEO',
            'rows' => $rows,
        ], 'layouts/admin');
    }

    public function store(Request $request): void
    {
        $routeKey = trim((string) $request->input('route_key', ''), " /\t\n\r\0\x0B");

        if ($routeKey === '') {
            Session::flash('admin_error', 'A route is required.');
            $this->redirect('/admin/seo');
            return;
        }

        SeoMetadata::upsert($routeKey === '/' ? 'home' : $routeKey, [
            'meta_title' => trim((string) $request->input('meta_title', '')) ?: null,
            'meta_description' => trim((string) $request->input('meta_description', '')) ?: null,
            'canonical_url' => trim((string) $request->input('canonical_url', '')) ?: null,
            'og_title' => trim((string) $request->input('og_title', '')) ?: null,
            'og_description' => trim((string) $request->input('og_description', '')) ?: null,
            'og_image' => trim((string) $request->input('og_image', '')) ?: null,
        ]);

        Session::flash('admin_success', 'SEO settings saved for "' . $routeKey . '".');
        $this->redirect('/admin/seo');
    }

    public function delete(Request $request, array $params): void
    {
        SeoMetadata::delete((int) $params['id']);
        Session::flash('admin_success', 'SEO override removed — that page will use its default title and description again.');
        $this->redirect('/admin/seo');
    }
}
