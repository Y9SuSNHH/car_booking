<?php

namespace App\Http\Controllers;

use App\Enums\CarStatusEnum;
use App\Enums\FileTypeEnum;
use App\Http\Requests\Car\CheckSlugRequest;
use App\Http\Requests\Car\FindCarRequest;
use App\Http\Requests\Car\GenerateSlugRequest;
use App\Models\Car;
use App\Models\File;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use function PHPUnit\Framework\isNull;

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
        try {
            $query        = $this->model->clone()->latest();
            $selectedName = $request->get('name');

            if (!empty($selectedName) && $selectedName !== 'All') {
                $query->where('name', $selectedName);
            }

            if ($request->get('address') !== null && $request->get('amp;date_start') !== null && $request->get('amp;date_end') !== null) {
                $address    = $request->get('address');
                $date_start = date('Y-m-d', strtotime($request->get('amp;date_start')));
                $date_end   = date('Y-m-d', strtotime($request->get('amp;date_end')));
                $query->where('address', $address)
                    ->where('status', CarStatusEnum::READY)
                    ->whereDoesntHave('bills', function ($query) use ($date_start, $date_end, $address) {
                        $query->where(function ($q) use ($date_start, $date_end) {
                            $q->orwhereRaw("date_start BETWEEN CAST('$date_start'  AS DATE) AND CAST('$date_end' AS DATE)");
                            $q->orwhereRaw("date_end   BETWEEN CAST('$date_start' AS DATE)  AND CAST('$date_end' AS DATE)");
                        });
                    });
            }

            $data = $query->paginate(10);

            foreach ($data as $each) {
                $each->append('status_name');
                $each->type = $each->TypeName;
            }
            $arr['data']       = $data->getCollection();
            $arr['pagination'] = $data->linkCollection();
            return $this->successResponse($arr);
        } catch (Throwable $e) {
            return $this->errorResponse();
        }
    }

    public function show($carId)
    {
        try {
            $query = $this->model->clone();
            $query->where('id', $carId);
            $query->with([
                'files' => function ($q) use ($carId) {
                    $q->where('table_id', $carId);
                }
            ]);
            $each = $query->get();
            return $this->successResponse($each);
        } catch (Throwable $e) {
            return $this->errorResponse();
        }
    }

    public function generateSlug(GenerateSlugRequest $request): JsonResponse
    {
        try {
            $name = $request->get('name');
            $slug = SlugService::createSlug(Car::class, 'slug', $name);

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
