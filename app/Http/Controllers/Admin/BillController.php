<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Car;
use App\Models\User;
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

    public function index(Request $request)
    {
        $filter['car_name']        = $request->get('car_name');
        $filter['user_name']       = $request->get('user_name');
        $filter['user_start_name'] = $request->get('user_start_name');
        $filter['user_end_name']   = $request->get('user_end_name');

        $query = $this->model->clone();

//        if (!empty($filter['car_name']) && $filter['car_name'] !== 'All') {
//            $query->where('name', $filter['car_name']);
//        }
//        if (!empty($filter['user_name']) && $filter['user_name'] !== 'All') {
//            $query->where('name', $filter['user_name']);
//        }
//        if (!empty($filter['car_name']) && $filter['car_name'] !== 'All') {
//            $query->where('name', $filter['user_start_name']);
//        }
//        if (!empty($filter['car_name']) && $filter['car_name'] !== 'All') {
//            $query->where('name', $filter['user_start_name']);
//        }
//        $query->with([
//            'user' => function ($q) {
//                $q->select('name');
//            }
//        ]);
        $query->with('user');
        $query->with('car');
        $data = $query->latest()->paginate(10);
        return view("$this->role.$this->table.index", [
            'data' => $data,
        ]);
    }

    public function create(Request $request, Car $car)
    {
        $user = User::create($request->except(['identity', 'license_car']));
        return 1;
    }

    public function store(Request $request, Car $car)
    {
        dd(1);
    }
}
