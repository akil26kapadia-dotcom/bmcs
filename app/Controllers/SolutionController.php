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
            'title' => 'Solutions We Deliver in Dubai & UAE',
            'description' => 'TallyPrime solutions plus network infrastructure, cloud, security, telecommunication, Microsoft, IT support and digital services delivered by Bright Mind Computer Solutions in Dubai and the UAE.',
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

        // Tally Solutions is a distinct product line, not just another IT
        // service area — cross-linking the unrelated categories (CCTV, audio
        // visual, etc.) here would dilute the dedicated positioning it needs.
        $otherCategories = $params['slug'] === 'tally-solutions'
            ? []
            : array_values(array_filter(
                ServiceCategory::allOrdered(),
                fn ($c) => $c['id'] !== $category['id']
            ));

        $isTally = $params['slug'] === 'tally-solutions';

        $this->view('pages/solutions/show', [
            'title' => $isTally ? 'TallyPrime Solutions in Dubai & UAE' : $category['name'],
            'description' => $isTally
                ? 'TallyPrime Dubai and UAE: sales and licensing, TSS renewal, Tally on Cloud, TallyPrime Server, customization, support and AMC, and data migration from Bright Mind Computer Solutions.'
                : $category['description'],
            'category' => $category,
            'services' => Service::byCategorySlug($params['slug']),
            'otherCategories' => $otherCategories,
        ]);
    }
}
