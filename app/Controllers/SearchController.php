<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\PortfolioProject;
use App\Models\Post;
use App\Models\Service;

class SearchController extends Controller
{
    public function index(Request $request): void
    {
        $term = trim((string) $request->query('q', ''));

        $results = $term === '' ? [] : [
            'posts' => Post::search($term),
            'services' => Service::search($term),
            'portfolio' => PortfolioProject::search($term),
        ];

        $count = $term === '' ? 0 : array_sum(array_map('count', $results));

        $this->view('pages/search', [
            'title' => $term === '' ? 'Search' : 'Search Results for "' . $term . '"',
            'term' => $term,
            'count' => $count,
            'results' => $results,
        ]);
    }
}
