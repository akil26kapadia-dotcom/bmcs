<?php

use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ContactSubmissionController;
use App\Controllers\Admin\ContentController;
use App\Controllers\Admin\MenuController;
use App\Controllers\Admin\ProductCategoryController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\MediaController;
use App\Controllers\Admin\PostController;
use App\Controllers\Admin\SeoController;
use App\Controllers\Admin\SettingsController;
use App\Controllers\Admin\TagController;
use App\Controllers\BlogController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\PortfolioController;
use App\Controllers\SearchController;
use App\Controllers\ServiceController;
use App\Controllers\SitemapController;
use App\Controllers\SolutionController;
use App\Core\Router;
use App\Middleware\AuthMiddleware;
use App\Middleware\CsrfMiddleware;

return function (Router $router): void {
    // --- Public site ------------------------------------------------
    $router->get('/', [HomeController::class, 'index']);
    $router->get('/about', [PageController::class, 'about']);
    $router->get('/privacy-policy', [PageController::class, 'privacy']);
    $router->get('/terms-and-conditions', [PageController::class, 'terms']);
    $router->get('/sitemap', [PageController::class, 'sitemapHtml']);
    $router->get('/sitemap.xml', [SitemapController::class, 'xml']);
    $router->get('/products', [PageController::class, 'products']);

    $router->get('/services', [ServiceController::class, 'index']);
    $router->get('/services/{slug}', [ServiceController::class, 'show']);

    $router->get('/solutions', [SolutionController::class, 'index']);
    $router->get('/solutions/{slug}', [SolutionController::class, 'show']);

    $router->get('/portfolio', [PortfolioController::class, 'index']);
    $router->get('/portfolio/{slug}', [PortfolioController::class, 'show']);

    $router->get('/blog', [BlogController::class, 'index']);
    $router->get('/blog/category/{slug}', [BlogController::class, 'category']);
    $router->get('/blog/tag/{slug}', [BlogController::class, 'tag']);
    $router->get('/blog/{slug}', [BlogController::class, 'show']);

    $router->get('/contact', [ContactController::class, 'index']);
    $router->post('/contact', [ContactController::class, 'submit'], [CsrfMiddleware::class]);

    $router->get('/search', [SearchController::class, 'index']);

    // --- Admin: auth (no AuthMiddleware — this is how you get a session) ---
    $router->get('/admin/login', [AuthController::class, 'showLogin']);
    $router->post('/admin/login', [AuthController::class, 'login'], [CsrfMiddleware::class]);
    $router->post('/admin/logout', [AuthController::class, 'logout'], [CsrfMiddleware::class]);

    // --- Admin: protected area ---------------------------------------
    $router->group('/admin', [AuthMiddleware::class], function (Router $router) {
        $router->get('/dashboard', [DashboardController::class, 'index']);

        $router->get('/posts', [PostController::class, 'index']);
        $router->get('/posts/create', [PostController::class, 'create']);
        $router->post('/posts', [PostController::class, 'store'], [CsrfMiddleware::class]);
        $router->get('/posts/edit/{id}', [PostController::class, 'edit']);
        $router->post('/posts/update/{id}', [PostController::class, 'update'], [CsrfMiddleware::class]);
        $router->post('/posts/delete/{id}', [PostController::class, 'delete'], [CsrfMiddleware::class]);

        $router->get('/categories', [CategoryController::class, 'index']);
        $router->post('/categories', [CategoryController::class, 'store'], [CsrfMiddleware::class]);
        $router->post('/categories/delete/{id}', [CategoryController::class, 'delete'], [CsrfMiddleware::class]);

        $router->get('/tags', [TagController::class, 'index']);
        $router->post('/tags', [TagController::class, 'store'], [CsrfMiddleware::class]);
        $router->post('/tags/delete/{id}', [TagController::class, 'delete'], [CsrfMiddleware::class]);

        $router->get('/media', [MediaController::class, 'index']);
        $router->post('/media/upload', [MediaController::class, 'upload'], [CsrfMiddleware::class]);
        $router->post('/media/delete/{id}', [MediaController::class, 'delete'], [CsrfMiddleware::class]);

        $router->get('/contacts', [ContactSubmissionController::class, 'index']);
        $router->post('/contacts/read/{id}', [ContactSubmissionController::class, 'markRead'], [CsrfMiddleware::class]);

        $router->get('/menus', [MenuController::class, 'index']);
        $router->post('/menus', [MenuController::class, 'store'], [CsrfMiddleware::class]);
        $router->post('/menus/delete/{id}', [MenuController::class, 'delete'], [CsrfMiddleware::class]);

        $router->get('/products', [ProductCategoryController::class, 'index']);
        $router->post('/products', [ProductCategoryController::class, 'store'], [CsrfMiddleware::class]);
        $router->post('/products/update/{id}', [ProductCategoryController::class, 'update'], [CsrfMiddleware::class]);
        $router->post('/products/delete/{id}', [ProductCategoryController::class, 'delete'], [CsrfMiddleware::class]);

        $router->get('/content', [ContentController::class, 'index']);
        $router->post('/content/{group}', [ContentController::class, 'update'], [CsrfMiddleware::class]);

        $router->get('/settings', [SettingsController::class, 'index']);
        $router->post('/settings', [SettingsController::class, 'update'], [CsrfMiddleware::class]);
        $router->post('/settings/password', [SettingsController::class, 'updatePassword'], [CsrfMiddleware::class]);

        $router->get('/seo', [SeoController::class, 'index']);
        $router->post('/seo', [SeoController::class, 'store'], [CsrfMiddleware::class]);
        $router->post('/seo/delete/{id}', [SeoController::class, 'delete'], [CsrfMiddleware::class]);
    });
};
