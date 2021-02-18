<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\SliderService;

// requests...
use Modules\Cms\Http\Requests\SliderStoreRequest;
use Modules\Cms\Http\Requests\SliderUpdateRequest;

// resources...
use Modules\Cms\Transformers\SliderResource;

class SliderController extends Controller
{
    /**
     * @var $sliderService
     */
    protected $sliderService;

    /**
     * Constructor
     *
     * @param SliderService $sliderService
     */
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    /**
     * Slider list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all sliders
        $sliders = $this->sliderService->all(request()->get('limit') ?? 0);
        // if no slider found
        if (!count($sliders)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Slider not available.');
        }
        // transform sliders
        $sliders = SliderResource::collection($sliders);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($sliders);
    }

    /**
     * Store a slider.
     *
     * @param SliderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderStoreRequest $request)
    {
        // create slider
        $slider = $this->sliderService->create($request->all());
        // check if created
        if ($slider) {
            // transform slider
            $slider = SliderResource::make($slider);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Slider created successfully.')
                ->data($slider);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Slider cannot be created.');
        }
    }

    /**
     * Show slider.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get slider
        $slider = $this->sliderService->find($id);
        // if no slider found
        if (empty($slider)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Slider not found.');
        }
        // transform slider
        $slider = SliderResource::make($slider);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Slider is available.')
            ->data($slider);
    }

    /**
     * Update slider.
     *
     * @param SliderUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUpdateRequest $request, $id)
    {
        // get slider
        $slider = $this->sliderService->find($id);
        // if no slider found
        if (empty($slider)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Slider not found.');
        }
        // update slider
        $slider = $this->sliderService->update($request->all(), $id);
        // check if updated
        if ($slider) {
            // get updated slider
            $slider = $this->sliderService->find($id);
            // transform slider
            $slider = SliderResource::make($slider);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Slider updated successfully.')
                ->data($slider);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Slider cannot be updated.');
        }
    }

    /**
     * Remove slider.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get slider
        $slider = $this->sliderService->find($id);
        // if no slider found
        if (empty($slider)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Slider not found.');
        }
        // delete slider
        if ($this->sliderService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Slider deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Slider cannot be deleted.');
        }
    }
}
