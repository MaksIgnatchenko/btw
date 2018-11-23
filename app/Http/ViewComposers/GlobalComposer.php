<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 01.11.2018
 */

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GlobalComposer
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $merchant;

    /**
     * StoreComposer constructor.
     */
    public function __construct()
    {
        $this->merchant = Auth::user();
    }


    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('merchant', $this->merchant);
    }
}
