<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Helpers\SiteConfig;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;

class PageController extends Controller
{
    public function about(Request $request): void
    {
        $this->view('pages/about', [
            'title' => 'About BMCS',
            'description' => 'Bright Mind Computer Solutions (BMCS) is a Dubai-based IT and technology solutions provider delivering enterprise computing, networking, security and digital services across the UAE.',
            'categories' => ServiceCategory::allOrdered(),
        ]);
    }

    public function privacy(Request $request): void
    {
        $this->view('pages/privacy', [
            'title' => 'Privacy Policy',
            'description' => 'How Bright Mind Computer Solutions (BMCS) collects, uses and protects your information.',
            'siteEmail' => SiteConfig::get('site_email'),
        ]);
    }

    public function terms(Request $request): void
    {
        $this->view('pages/terms', [
            'title' => 'Terms & Conditions',
            'description' => 'The terms and conditions governing use of the Bright Mind Computer Solutions (BMCS) website.',
            'siteEmail' => SiteConfig::get('site_email'),
        ]);
    }

    public function sitemapHtml(Request $request): void
    {
        $this->view('pages/sitemap', [
            'title' => 'Sitemap',
            'description' => 'A full overview of the pages available on the BMCS website.',
            'categories' => ServiceCategory::allOrdered(),
            'services' => Service::published(),
            'blogCategories' => Category::all('name ASC'),
            'recentPosts' => Post::paginate([], 1, 12)['items'],
        ]);
    }

    public function products(Request $request): void
    {
        // No dedicated products table yet (not in the required Phase 2 schema —
        // see Phase 2 notes). Static content for now; swapping this for a
        // database-backed Product model later won't require any route/view changes.
        $this->view('pages/products', [
            'title' => 'IT Products & Distribution',
            'description' => 'BMCS supplies and configures servers, desktops, laptops, networking equipment and IT accessories for businesses across Dubai and the UAE.',
            'categories' => [
                ['name' => 'Servers', 'icon' => 'briefcase', 'description' => 'Rack and tower servers configured for business workloads.'],
                ['name' => 'Desktops', 'icon' => 'monitor', 'description' => 'Business desktop computers for offices of any size.'],
                ['name' => 'Laptops', 'icon' => 'monitor', 'description' => 'Laptops for office, hybrid and mobile workforces.'],
                ['name' => 'Networking Equipment', 'icon' => 'network', 'description' => 'Switches, routers and access points for reliable connectivity.'],
                ['name' => 'Accessories', 'icon' => 'layers', 'description' => 'Peripherals and accessories to complete your setup.'],
                ['name' => 'Security Equipment', 'icon' => 'shield', 'description' => 'CCTV cameras, access control hardware and related equipment.'],
                ['name' => 'Storage', 'icon' => 'cloud', 'description' => 'Storage devices and solutions for business data.'],
                ['name' => 'IT Infrastructure', 'icon' => 'life-buoy', 'description' => 'Core infrastructure hardware for your IT environment.'],
            ],
        ]);
    }
}
