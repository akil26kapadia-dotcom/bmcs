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
        $this->view('pages/home', [
            // Overridable in Admin > SEO ('home' route) — these are just the fallback.
            'title' => 'TallyPrime Solutions & Complete IT Services in Dubai, UAE',
            'preloadHero' => true,
            'description' => 'Bright Mind Computer Solutions LLC: TallyPrime sales, TSS renewal, Tally on Cloud, TallyPrime Server, customization and support in Dubai and the UAE, plus IT hardware, servers, networking, cybersecurity, CCTV and AMC.',
            'serviceCategories' => ServiceCategory::allOrdered(),
            'tallyServices' => Service::byCategorySlug('tally-solutions'),
            'latestPosts' => Post::published(3),
        ]);
    }
}
