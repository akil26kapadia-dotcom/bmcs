<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\PortfolioProject;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;

class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/home', [
            'title' => 'TallyPrime & Complete IT Solutions in Dubai',
            'description' => 'BMCS is a Dubai-based TallyPrime partner and IT solutions provider — TallyPrime sales, renewal, customization and cloud hosting, plus networking, security, cloud and digital solutions across the UAE.',
            'serviceCategories' => ServiceCategory::allOrdered(),
            'tallyServices' => Service::byCategorySlug('tally-solutions'),
            'portfolioProjects' => PortfolioProject::published(),
            'latestPosts' => Post::published(3),
        ]);
    }
}
