<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Helpers\SiteConfig;
use App\Models\Category;
use App\Models\Post;
use App\Models\ProductCategory;
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
        // Categories are managed in Admin > Product Categories.
        $this->view('pages/products', [
            'title' => 'IT Products & Distribution',
            'description' => 'BMCS supplies and configures servers, desktops, laptops, networking equipment and IT accessories for businesses across Dubai and the UAE.',
            'categories' => ProductCategory::allOrdered(),
        ]);
    }
}
