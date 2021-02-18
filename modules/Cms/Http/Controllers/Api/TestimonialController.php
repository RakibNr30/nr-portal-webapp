<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\TestimonialService;

// requests...
use Modules\Cms\Http\Requests\TestimonialStoreRequest;
use Modules\Cms\Http\Requests\TestimonialUpdateRequest;

// resources...
use Modules\Cms\Transformers\TestimonialResource;

class TestimonialController extends Controller
{
    /**
     * @var $testimonialService
     */
    protected $testimonialService;

    /**
     * Constructor
     *
     * @param TestimonialService $testimonialService
     */
    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    /**
     * Testimonial list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all testimonials
        $testimonials = $this->testimonialService->all(request()->get('limit') ?? 0);
        // if no testimonial found
        if (!count($testimonials)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Testimonial not available.');
        }
        // transform testimonials
        $testimonials = TestimonialResource::collection($testimonials);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($testimonials);
    }

    /**
     * Store a testimonial.
     *
     * @param TestimonialStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialStoreRequest $request)
    {
        // create testimonial
        $testimonial = $this->testimonialService->create($request->all());
        // check if created
        if ($testimonial) {
            // transform testimonial
            $testimonial = TestimonialResource::make($testimonial);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Testimonial created successfully.')
                ->data($testimonial);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Testimonial cannot be created.');
        }
    }

    /**
     * Show testimonial.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get testimonial
        $testimonial = $this->testimonialService->find($id);
        // if no testimonial found
        if (empty($testimonial)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Testimonial not found.');
        }
        // transform testimonial
        $testimonial = TestimonialResource::make($testimonial);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Testimonial is available.')
            ->data($testimonial);
    }

    /**
     * Update testimonial.
     *
     * @param TestimonialUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialUpdateRequest $request, $id)
    {
        // get testimonial
        $testimonial = $this->testimonialService->find($id);
        // if no testimonial found
        if (empty($testimonial)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Testimonial not found.');
        }
        // update testimonial
        $testimonial = $this->testimonialService->update($request->all(), $id);
        // check if updated
        if ($testimonial) {
            // get updated testimonial
            $testimonial = $this->testimonialService->find($id);
            // transform testimonial
            $testimonial = TestimonialResource::make($testimonial);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Testimonial updated successfully.')
                ->data($testimonial);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Testimonial cannot be updated.');
        }
    }

    /**
     * Remove testimonial.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get testimonial
        $testimonial = $this->testimonialService->find($id);
        // if no testimonial found
        if (empty($testimonial)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Testimonial not found.');
        }
        // delete testimonial
        if ($this->testimonialService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Testimonial deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Testimonial cannot be deleted.');
        }
    }
}
