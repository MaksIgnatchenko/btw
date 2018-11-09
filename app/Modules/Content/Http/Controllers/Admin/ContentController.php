<?php

namespace App\Modules\Content\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Content\Enums\ContentKeyEnum;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $contents = $this->contentRepository->find([
            ContentKeyEnum::TERMS_AND_CONDITIONS,
            ContentKeyEnum::PRIVACY_POLICY,
        ]);

        return view('contents.admin.index')
            ->with('contents', $contents);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aboutUs()
    {
        $content = $this->contentRepository->find(ContentKeyEnum::ABOUT_US);
        return view('contents.admin.about_us')
            ->with('content', $content);
    }

    /**
     * @param                      $key
     * @param UpdateContentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Prettus\Validator\Exceptions\ValidatorException
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

        return back();
    }
}
