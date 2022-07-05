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

    public function index(): JsonResponse
    {
        $data = $this->model->paginate();
        foreach ($data as $each) {
            $each->type   = $each->type_name;
            $each->status = $each->status_name;
        }
        $arr['success']    = true;
        $arr['data']       = $data->getCollection();
        $arr['pagination'] = $data->linkCollection();

        return $this->successResponse($arr);
    }
}
