<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CarStatusEnum;
use App\Enums\CarTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Car\CarStoreRequest;
use App\Http\Requests\Car\CarUpdateRequest;
use App\Models\Car;
use Illuminate\Support\Facades\View;

class CarController extends Controller
{

    private object $model;
    private string $table;
    private string $role = 'admin';

    public function __construct()
    {
        $this->model = Car::query();
        $this->table = (new Car())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function index()
    {
        $query = $this->model->clone()->latest();
        $data  = $query->paginate();
        return view("$this->role.$this->table.index", [
            'data' => $data,
        ]);
    }

    public function create()
    {
        $types  = CarTypeEnum::getArrayView();
        $status = CarStatusEnum::getArrayView();
        return view("$this->role.$this->table.create", [
            'types'  => $types,
            'status' => $status,
        ]);
    }

    public function store(CarStoreRequest $request, Car $car)
    {
        if ($request->has('file_upload')) {
            $file      = $request->file_upload;
            $ext       = $request->file_upload->extension();
            $file_name = time() . '-' . 'car' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
            $request->merge(['image' => $file_name]);
        }
        
        $car->create($request->all());
        return redirect()->route("$this->role.$this->table.index");
    }

    public function show($id)
    {
        //
    }


    public function edit(Car $car)
    {
        $types     = CarTypeEnum::getArrayView();
        $arrStatus = CarStatusEnum::getArrayView();
        return view("$this->role.$this->table.edit", [
            'each'      => $car,
            'types'     => $types,
            'arrStatus' => $arrStatus,
        ]);
    }

    public function update(CarUpdateRequest $request, Car $car)
    {
        $image_path = app_path("uploads/{$request->ole_image}");
        if (!empty($request->new_image)) {
            unlink($image_path);
            $file      = $request->new_image;
            $ext       = $request->new_image->extension();
            $file_name = time() . '-' . 'car' . '.' . $ext;
            $file->move(public_path('uploads'), $file_name);
            $request->merge(['image' => $file_name]);
        }

        $car->update($request->validated());

        return redirect()->route("$this->role.$this->table.index");

    }

    public function destroy($carId)
    {
        Car::destroy($carId);

        return redirect()->back();
    }
}
