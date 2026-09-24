<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Helpers\Url;
use App\Models\PortfolioProject;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;

class SitemapController extends Controller
{
    public function xml(Request $request): void
    {
        $urls = [
            ['loc' => Url::full('/'), 'priority' => '1.0'],
            ['loc' => Url::full('about'), 'priority' => '0.8'],
            ['loc' => Url::full('services'), 'priority' => '0.9'],
            ['loc' => Url::full('solutions'), 'priority' => '0.9'],
            ['loc' => Url::full('products'), 'priority' => '0.6'],
            ['loc' => Url::full('blog'), 'priority' => '0.7'],
            ['loc' => Url::full('contact'), 'priority' => '0.6'],
        ];

        foreach (ServiceCategory::allOrdered() as $category) {
            $urls[] = ['loc' => Url::full('solutions/' . $category['slug']), 'priority' => '0.7'];
        }

        foreach (Service::published() as $service) {
            $urls[] = ['loc' => Url::full('services/' . $service['slug']), 'priority' => '0.7'];
        }

        foreach (PortfolioProject::published() as $project) {
            $urls[] = ['loc' => Url::full('portfolio/' . $project['slug']), 'priority' => '0.5'];
        }

        $posts = Post::paginate([], 1, 1000)['items'];
        foreach ($posts as $post) {
            $urls[] = [
                'loc' => Url::full('blog/' . $post['slug']),
                'priority' => '0.6',
                'lastmod' => date('Y-m-d', strtotime($post['updated_at'])),
            ];
        }

        header('Content-Type: application/xml; charset=UTF-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $url) {
            echo '  <url>' . "\n";
            echo '    <loc>' . htmlspecialchars($url['loc'], ENT_XML1) . '</loc>' . "\n";
            if (!empty($url['lastmod'])) {
                echo '    <lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";
            }
            echo '    <priority>' . $url['priority'] . '</priority>' . "\n";
            echo '  </url>' . "\n";
        }
        echo '</urlset>';
    }
}
