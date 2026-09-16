<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\PortfolioProject;
use App\Models\Post;
use App\Models\ServiceCategory;

class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/home', [
            'title' => 'IT Infrastructure & Technology Solutions in Dubai',
            'description' => 'BMCS delivers enterprise IT infrastructure, networking, security, cloud, telecommunication and digital solutions for businesses across Dubai and the UAE.',
            'serviceCategories' => ServiceCategory::allOrdered(),
            'portfolioProjects' => PortfolioProject::published(),
            'latestPosts' => Post::published(3),
        ]);
    }
}
