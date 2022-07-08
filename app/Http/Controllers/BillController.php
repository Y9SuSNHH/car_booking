<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BillController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = Bill::query();
        $this->table = (new Bill())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }
    public function store()
    {
       return view("admin.$this->table.index");
    }
}
