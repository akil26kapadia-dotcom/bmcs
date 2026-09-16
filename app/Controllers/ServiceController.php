<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function index(Request $request): void
    {
        $categories = ServiceCategory::allOrdered();
        $services = Service::published();

        $grouped = [];
        foreach ($categories as $category) {
            $grouped[$category['id']] = [
                'category' => $category,
                'services' => [],
            ];
        }
        foreach ($services as $service) {
            if (isset($grouped[$service['category_id']])) {
                $grouped[$service['category_id']]['services'][] = $service;
            }
        }

        $this->view('pages/services/index', [
            'title' => 'Our Services',
            'description' => 'Explore the full range of IT infrastructure, security, cloud, telecommunication and digital services BMCS delivers across Dubai and the UAE.',
            'categories' => $categories,
            'grouped' => $grouped,
        ]);
    }

    public function show(Request $request, array $params): void
    {
        $service = Service::publishedBySlug($params['slug']);

        if ($service === null) {
            http_response_code(404);
            $this->view('pages/404', ['title' => 'Service Not Found']);
            return;
        }

        $category = $service['category_id'] ? ServiceCategory::find((int) $service['category_id']) : null;

        // Service-level content overrides the category template; falls back
        // to the category's shared content when the service hasn't defined its own.
        $capabilities = !empty($service['capabilities']) ? $service['capabilities'] : ($category['capabilities'] ?? []);
        $benefits = !empty($service['benefits']) ? $service['benefits'] : ($category['benefits'] ?? []);
        $applications = !empty($service['applications']) ? $service['applications'] : ($category['applications'] ?? []);
        $faq = !empty($service['faq']) ? $service['faq'] : ($category['faq'] ?? []);

        $related = Service::relatedTo((int) $service['category_id'], (int) $service['id']);

        $this->view('pages/services/show', [
            'title' => $service['meta_title'] ?: $service['name'],
            'description' => $service['meta_description'] ?: $service['short_description'],
            'service' => $service,
            'category' => $category,
            'capabilities' => $capabilities,
            'benefits' => $benefits,
            'applications' => $applications,
            'faq' => $faq,
            'related' => $related,
        ]);
    }
}
