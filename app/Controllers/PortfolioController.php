<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\PortfolioProject;
use App\Models\ServiceCategory;

class PortfolioController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/portfolio/index', [
            'title' => 'Portfolio',
            'description' => 'Representative examples of the network, security, cloud and digital projects BMCS delivers for businesses across Dubai and the UAE.',
            'projects' => PortfolioProject::published(),
            'categories' => ServiceCategory::allOrdered(),
        ]);
    }

    public function show(Request $request, array $params): void
    {
        $project = PortfolioProject::publishedBySlug($params['slug']);

        if ($project === null) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Project Not Found']);
            return;
        }

        $related = PortfolioProject::relatedTo(
            $project['category_id'] ? (int) $project['category_id'] : null,
            (int) $project['id']
        );

        $this->view('pages/portfolio/show', [
            'title' => $project['title'],
            'description' => $project['summary'],
            'project' => $project,
            'related' => $related,
        ]);
    }
}
