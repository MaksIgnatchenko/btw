<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 7.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Content\Models\Content;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function index(string $key)
    {
        $content = Content::findOrFail($key);
        $merchant = Auth::guard('merchant')->user();

        return view('merchants.web.content', [
            'content' => $content,
            'merchant' => $merchant,
        ]);
    }
}
