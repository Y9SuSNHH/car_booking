<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BillController extends Controller
{
    private object $model;
    private string $table;
    private string $role = 'admin';

    public function __construct()
    {
        $this->model = Bill::query();
        $this->table = (new Bill())->getTable();

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
    public function create(Car $car)
    {
        return view("$this->role.$this->table.create",[
            'car'      => $car,
        ]);
    }
    public function store(Request $request, Car $car)
    {
        dd(1);
    }
}
