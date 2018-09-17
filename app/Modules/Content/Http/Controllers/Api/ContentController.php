<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.11.2017
 */

namespace App\Modules\Content\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Content\Repositories\ContentRepository;
use Illuminate\Http\JsonResponse;

class ContentController extends Controller
{
    /** @var  ContentRepository */
    protected $contentRepository;

    /**
     * ContentController constructor.
     *
     * @param ContentRepository $contentRepo
     */
    public function __construct(ContentRepository $contentRepo)
    {
        $this->contentRepository = $contentRepo;
    }

    /**
     * @param string $key
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \InvalidArgumentException
     */
    public function get(string $key): JsonResponse
    {
        $content = $this->contentRepository->getContentByKey($key);
        if (null === $content) {
            return response()
                ->json(['message' => "No content with key {$key}"])
                ->setStatusCode(400);
        }

        return response()->json([
            'content' => $content,
        ]);
    }
}
