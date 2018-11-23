<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 22.11.2018
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class SettingsComposer
{
    /**
     * @var array
     */
    protected $configs;

    /**
     * StoreComposer constructor.
     */
    public function __construct()
    {
        $this->configs = config('wish.storage');
    }


    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('configs', $this->configs);
    }
}
