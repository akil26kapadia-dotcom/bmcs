<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;

class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/home', $this->homeData() + ['preloadHero' => true]);
    }

    /**
     * New homepage design, served at /preview/home (hidden from search
     * engines) until it replaces the main homepage.
     */
    public function preview(Request $request): void
    {
        $this->view('pages/home-v2', $this->homeData() + [
            'noindex' => true,
            'pageScripts' => ['/assets/js/home.js'],
        ]);
    }

    private function homeData(): array
    {
        $categories = ServiceCategory::allOrdered();

        return [
            // Overridable in Admin > SEO ('home' route) — these are just the fallback.
            'title' => 'TallyPrime Solutions & Complete IT Services in Dubai, UAE',
            'description' => 'Bright Mind Computer Solutions LLC: TallyPrime sales, TSS renewal, Tally on Cloud, TallyPrime Server, customization and support in Dubai and the UAE, plus IT hardware, servers, networking, cybersecurity, CCTV and AMC.',
            'serviceCategories' => $categories,
            'tallyServices' => Service::byCategorySlug('tally-solutions'),
            'allServices' => Service::published(),
            'latestPosts' => Post::published(3),
        ];
    }
}
