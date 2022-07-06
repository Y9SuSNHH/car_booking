<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
        $data = $this->model
            ->where('name','like','%'.$request->get('1').'%')
            ->get();
//        foreach ($data as $each) {
//            $each->type   = $each->type_name;
//            $each->status = $each->status_name;
//        }

        return $this->successResponse($data);
    }
}
