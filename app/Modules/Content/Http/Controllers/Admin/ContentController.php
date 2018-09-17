<?php

namespace App\Modules\Content\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Content\Http\Requests\Admin\UpdateContentRequest;
use App\Modules\Content\Repositories\ContentRepository;
use Flash;
use Response;

class ContentController extends Controller
{
    /** @var  ContentRepository */
    protected $contentRepository;

    public function __construct(ContentRepository $contentRepo)
    {
        $this->contentRepository = $contentRepo;
    }


    public function index()
    {
        $contents = $this->contentRepository->all();

        return view('contents.index')
            ->with('contents', $contents);
    }

    /**
     * Update the specified Content in storage.
     *
     * @param  int $key
     * @param UpdateContentRequest $request
     *
     * @return Response
     */
    public function update($key, UpdateContentRequest $request)
    {
        $content = $this->contentRepository->findWithoutFail($key);

        if (null === $content) {
            Flash::error('Content not found');

            return redirect(route('content'));
        }

        $this->contentRepository->update($request->all(), $key);

        Flash::success('Content updated successfully.');

        return redirect(route('content'));
    }
}
