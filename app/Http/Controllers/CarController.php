<?php

namespace App\Http\Controllers;

use App\Enums\FileTypeEnum;
use App\Http\Requests\Car\CheckSlugRequest;
use App\Http\Requests\Car\GenerateSlugRequest;
use App\Models\Car;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends Controller
{
    use ResponseTrait;

    private object $model;

    public function __construct()
    {
        $this->model = Car::query();
    }

    public function index(Request $request): JsonResponse
    {
        $query        = $this->model->clone()->oldest();
        $selectedName = $request->get('name');

        if (!empty($selectedName) && $selectedName !== 'All') {
            $query->where('name', $selectedName);
        }

        $query->with(['files' => function($q) {
            $q->whereIn('type', [
                FileTypeEnum::CAR_IMAGE,
            ]);
        }]);

//        $names = $this->model->clone()
//            ->distinct()
//            ->pluck('name');

        $data = $query->paginate(3);

        foreach ($data as $each) {
            $each->append('status_name');
            $each->type = $each->TypeName;
        }

        $arr['data']       = $data->getCollection();
        $arr['pagination'] = $data->linkCollection();

        return $this->successResponse($arr);
//        return $this->errorResponse($arr);
    }

    public function generateSlug(GenerateSlugRequest $request): JsonResponse
    {
        try {
            $name = $request->get('name');
            $slug  = SlugService::createSlug(Car::class, 'slug', $name);

            return $this->successResponse($slug);
        } catch (Throwable $e) {
            return $this->errorResponse();
        }
    }

    public function checkSlug(CheckSlugRequest $request): JsonResponse
    {
        return $this->successResponse();
    }

}
