<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', static function ($trail) {
    $trail->push('Trang chủ', route('admin.welcome'));
});

// Home > Car
Breadcrumbs::for('user', static function ($trail) {
    $trail->parent('home');
    $trail->push('Quản lý người dùng', route('admin.users.index'));
});

// Home > Car > Show
Breadcrumbs::for('user.show', static function ($trail) {
    $trail->parent('user');
    $trail->push('Xem', route('admin.users.show'));
});

// Home > Car> Edit
Breadcrumbs::for('user.edit', static function ($trail) {
    $trail->parent('user');
    $trail->push('Sửa', route('admin.users.edit'));
});

// Home > Car
Breadcrumbs::for('car', static function ($trail) {
    $trail->parent('home');
    $trail->push('Quản lý xe', route('admin.cars.index'));
});
// Home > Car > Edit
Breadcrumbs::for('car.edit', static function ($trail) {
    $trail->parent('car');
    $trail->push('Sửa', route('admin.cars.edit'));
});

// Home > Bill
Breadcrumbs::for('bills', static function ($trail) {
    $trail->parent('home');
    $trail->push('Quản lý hóa đơn', route('admin.bills.index'));
});

// Home > Bill > Show
Breadcrumbs::for('bills.show', static function ($trail) {
    $trail->parent('bills');
    $trail->push('Xem', route('admin.bills.show'));
});

// Home > Bill > Edit
Breadcrumbs::for('bills.edit', static function ($trail) {
    $trail->parent('bills');
    $trail->push('Sửa', route('admin.bills.edit'));
});
