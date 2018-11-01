<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Products\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('products.web.index');
    }

    public function create()
    {
        //TODO create create product method
    }

    public function store()
    {
        //TODO create store product method
    }
}
