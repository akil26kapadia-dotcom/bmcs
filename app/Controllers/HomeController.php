<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;

class HomeController extends Controller
{
    /** The current homepage (new "living network" design). */
    public function index(Request $request): void
    {
        $this->view('pages/home-v2', $this->homeData() + ['pageScripts' => ['/assets/js/home.js']]);
    }

    /** The previous homepage design, kept at /preview/old-home for comparison. */
    public function previewOld(Request $request): void
    {
        $this->view('pages/home', $this->homeData() + ['preloadHero' => true, 'noindex' => true]);
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
