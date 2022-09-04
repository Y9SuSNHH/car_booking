<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Bill\BillStatusEnum;
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
        $filter['name_user'] = $request->get('name_user');
        $filter['name_car']  = $request->get('name_car');
        $filter['status']    = $request->get('status');

        $query = $this->model->clone();

        $status = BillStatusEnum::getArrayView();
        if (isset($filter['status']) && $filter['status'] !== 'All') {
            $query->where('status', $filter['status']);
        }
        if (!empty($filter['name_user']) && $filter['name_user'] !== 'All') {
            $name = $filter['name_user'];
            $query->whereHas('user', function ($q) use ($name) {
                $q->where('users.name', $name);
            });
        } else {
            $query->with('user');
        }
        if (!empty($filter['name_car']) && $filter['name_car'] !== 'All') {
            $name = $filter['name_car'];
            $query->whereHas('car', function ($q) use ($name) {
                $q->where('cars.name', $name);
            });
        } else {
            $query->with('car');
        }
        $nameUsers = User::query()->pluck('name');
        $nameCars  = Car::query()->pluck('name');
        $query->with('car');
        $data = $query->latest()->paginate(10);

        return view("$this->role.$this->table.index", [
            'data'      => $data,
            'filter'    => $filter,
            'nameUsers' => $nameUsers,
            'nameCars'  => $nameCars,
            'status'    => $status,
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
