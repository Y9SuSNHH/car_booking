<?php

namespace App\Http\Controllers\Admin;

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
        $data = Car::get();
        return view("$this->role.$this->table.index",[
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view("$this->role.$this->table.create");
    }

    public function store(CarStoreRequest $request, Car $car)
    {
        if($request->has('file_upload')){
            $file = $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().'-'.'product'.'.'.$ext;
            $file->move(public_path('uploads'), $file_name);
        }
        $request->merge(['image' => $file_name]);
        $car->create($request->all());
        return redirect()->route("$this->role.$this->table.index");
    }

    public function show($id)
    {
        //
    }


    public function edit(Car $car)
    {
        return view("$this->role.$this->table.edit",[
            'each' => $car
        ]);
    }

    public function update(CarUpdateRequest $request, Car $car)
    {
        $car->update($request ->validated());

        return redirect()->route("$this->role.$this->table.index");

    }

    public function destroy($car)
    {
        Car::destroy($car);
        return redirect()->route("$this->role.$this->table.index");
    }
}
