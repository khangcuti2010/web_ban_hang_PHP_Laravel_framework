<?php


namespace App\View\Composers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\View\View;


class MenuComposer
{
    protected $users;
    /**
     * Create a new profile composer.
     */
    public function __construct()
    {

    }

/**
 * Bind data to the view.
 */
    public function compose(View $view)
        {
            $menus = Menu::select('id','name','parent_id')->where('active', 1)->orderBy('id','asc')->get();
            $view->with('menus', $menus); // biến menus nhận toàn bộ thông tin của $menus
        }
}
