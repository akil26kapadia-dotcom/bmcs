<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Service;
use App\Models\ServiceCategory;

class SolutionController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('pages/solutions/index', [
            'title' => 'IT Solutions',
            'description' => 'Explore BMCS technology solutions across network infrastructure, cloud, security, telecommunication, Microsoft services, IT support and digital.',
            'categories' => ServiceCategory::allOrdered(),
        ]);
    }

    public function show(Request $request, array $params): void
    {
        $category = ServiceCategory::findBySlug($params['slug']);

        if ($category === null) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Solution Not Found']);
            return;
        }

        $this->view('pages/solutions/show', [
            'title' => $category['name'],
            'description' => $category['description'],
            'category' => $category,
            'services' => Service::byCategorySlug($params['slug']),
            'otherCategories' => array_values(array_filter(
                ServiceCategory::allOrdered(),
                fn ($c) => $c['id'] !== $category['id']
            )),
        ]);
    }
}
