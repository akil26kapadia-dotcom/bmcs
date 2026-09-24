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
            'title' => 'TallyPrime Solutions & Complete IT Services in Dubai, UAE',
            'preloadHero' => true,
            'titleOverride' => 'TallyPrime Dubai & UAE, plus Complete IT Services | BMCS',
            'description' => 'Bright Mind Computer Solutions LLC: TallyPrime sales, TSS renewal, Tally on Cloud, TallyPrime Server, customization and support in Dubai and the UAE, plus IT hardware, servers, networking, cybersecurity, CCTV and AMC.',
            'serviceCategories' => ServiceCategory::allOrdered(),
            'tallyServices' => Service::byCategorySlug('tally-solutions'),
            'latestPosts' => Post::published(3),
        ]);
    }
}
