<?php


namespace App\View\Composers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class CartComposer
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
        $carts = Session::get('carts');
        if(is_null($carts))
            return [];
        $productId = array_keys($carts);
        $product = Product::select('id', 'name', 'picture', 'price', 'price_sale')
                ->whereIn('id', $productId)
                ->where('active', 1)
                ->get();

        $view->with('products', $product);
    }
}
