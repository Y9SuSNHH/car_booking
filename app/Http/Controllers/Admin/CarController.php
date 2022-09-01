<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CarStatusEnum;
use App\Enums\CarTypeEnum;
use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\Car\StoreRequest;
use App\Http\Requests\Car\UpdateRequest;
use App\Models\Car;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Throwable;

class CarController extends Controller
{
    use ResponseTrait;

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

    public function index(Request $request)
    {
        $search      = $request->all();
        return view("$this->role.$this->table.index", [
            "search"      => $search,
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

    public function store(StoreRequest $request)
    {
        try {
            if ($request->has('photo')) {
                $path = Storage::disk('public')->putFile('car_images', $request->photo);
                $request->merge(['image' => $path]);
                $car = new Car($request->except(['photo', 'fullphoto']));
                $car->save();
            }
            if ($request->has("fullphoto")) {
                $files = $request->file("fullphoto");
                foreach ($files as $file) {
                    $path = Storage::disk('public')->putFile('car_images', $file);
                    File::create([
                        'table'    => FileTableEnum::CARS,
                        'table_id' => $car->id,
                        'type'     => FileTypeEnum::CAR_IMAGE,
                        'link'     => $path,
                    ]);
                }
            }
            return $this->successResponse();

        } catch (Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($carId)
    {
        $each   = Car::query()->find($carId);
        $types  = CarTypeEnum::getArrayView();
        $slots  = [4, 5, 7];
        $status = CarStatusEnum::getArrayView();
        return view("$this->role.$this->table.edit", [
            'each'   => $each,
            'types'  => $types,
            'slots'  => $slots,
            'status' => $status,
        ]);
    }

    public function update(UpdateRequest $request, Car $car)
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

    public function search()
    {
        $addressCars = Car::query()->clone()
            ->groupBy('address')
            ->pluck('address');
        return view("$this->role.$this->table.search",[
            "addressCars" => $addressCars,
        ]);
    }
}
