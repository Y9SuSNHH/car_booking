<?php

namespace App\Http\Controllers;

use App\Enums\FileTypeEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\File;

class   FileController extends Controller
{
    use ResponseTrait;
    private object $model;

    public function __construct()
    {
        $this->model = File::query();
    }

    public function carImage($carId): JsonResponse
    {
        $data = $this->model
            ->where('table_id', $carId)
            ->where('type', FileTypeEnum::CAR_IMAGE)
            ->get();
        return $this->successResponse($data);
    }
}
