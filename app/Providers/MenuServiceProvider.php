<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Route;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    // $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
    // $verticalMenuData = json_decode($verticalMenuJson);
    $menu = $this->verticalMenu();

    $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
    $horizontalMenuData = json_decode($horizontalMenuJson);

    // Share all menuData to all the views
    $this->app->make('view')->share('menuData', [$menu, $horizontalMenuData]);
  }

  public function verticalMenu()
  {
    // see resources/menu/verticalMenu.json
    $menu = [
      array(
        'name' => 'Dashboard',
        'icon' => 'menu-icon tf-icons ri-home-smile-line',
        'slug' => 'home',
        'url' => 'home',
        // 'show_to_roles' => ['superadmin', 'user'], // default show to all,
        // 'submenu' => []
      ),
      array(
        'name' => 'Users Management',
        'icon' => 'menu-icon tf-icons ri-user-line',
        'slug' => 'user',
        'url' => '#',
        'show_to_roles' => ['superadmin', 'admin'], // default show to all,
        'submenu' => [
          [
            'name' => 'Superadmin',
            'slug' => 'superadmin.index',
            'url' => 'superadmin.index',
          ]
        ]
      ),
    ];

    $result = json_encode(['menu' => $menu]);
    return json_decode($result);
  }
}
