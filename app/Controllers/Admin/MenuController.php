<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\MenuItem;

class MenuController extends Controller
{
    private const LOCATIONS = ['header' => 'Header Navigation', 'footer' => 'Footer Quick Links'];

    public function index(Request $request): void
    {
        $this->view('pages/admin/menus/index', [
            'title' => 'Menus',
            'locations' => self::LOCATIONS,
            'items' => MenuItem::allOrdered(),
        ], 'layouts/admin');
    }

    public function store(Request $request): void
    {
        $label = trim((string) $request->input('label', ''));
        $url = trim((string) $request->input('url', ''));
        $location = (string) $request->input('location', '');

        if ($label === '' || $url === '' || !isset(self::LOCATIONS[$location])) {
            Session::flash('admin_error', 'Label, URL and a valid location are required.');
            $this->redirect('/admin/menus');
            return;
        }

        MenuItem::create([
            'location' => $location,
            'label' => $label,
            'url' => $url,
            'open_new_tab' => $request->input('open_new_tab') ? 1 : 0,
            'sort_order' => (int) $request->input('sort_order', 100),
        ]);

        Session::flash('admin_success', 'Menu item added.');
        $this->redirect('/admin/menus');
    }

    public function delete(Request $request, array $params): void
    {
        MenuItem::delete((int) $params['id']);
        Session::flash('admin_success', 'Menu item removed.');
        $this->redirect('/admin/menus');
    }
}
