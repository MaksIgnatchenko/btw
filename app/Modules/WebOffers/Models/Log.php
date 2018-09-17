<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.02.2018
 */

namespace App\Modules\WebOffers\Models;

use App\Modules\WebOffers\Repositories\LogRepository;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'message',
    ];

    protected $casts = [
        'message' => 'string',
    ];

    public function create(): void
    {
        /** @var LogRepository $repository */
        $repository = app(LogRepository::class);
        $repository->save($this);
    }
}
