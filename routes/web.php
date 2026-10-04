<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MenuController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/gioi-thieu', function () {
    return '<h1>Đây là trang Giới thiệu</h1><p>Nội dung tùy ý ở đây</p>';
});

Route::get('/layout1', function () {
    return view('layout.layout1', [
        'title'        => 'Trang chủ LaptopShop',
        'content' => 'Đây là nội dung được truyền từ Route sang view.',
        'contentAlert' => '<script>alert("Xin chào! Chào mừng bạn đến với LaptopShop.");</script>'
    ]);
});


// sinh viên
Route::get('/sinhvien', [SinhVienController::class, 'index'])->name('sinhvien.index');
Route::get('/sinhvien/them', [SinhVienController::class, 'create'])->name('sinhvien.create');
Route::post('/sinhvien', [SinhVienController::class, 'store'])->name('sinhvien.store');
Route::get('/sinhvien/{id}', [SinhVienController::class, 'show'])->name('sinhvien.show');
Route::get('/sinhvien/{id}/sua', [SinhVienController::class, 'edit'])->name('sinhvien.edit');
Route::put('/sinhvien/{id}', [SinhVienController::class, 'update'])->name('sinhvien.update');
Route::delete('/sinhvien/{id}', [SinhVienController::class, 'destroy'])->name('sinhvien.destroy');


// lớp học
Route::get('/lophoc', [LopHocController::class, 'index'])->name('lophoc.index');
Route::get('/lophoc/them', [LopHocController::class, 'create'])->name('lophoc.create');
Route::post('/lophoc', [LopHocController::class, 'store'])->name('lophoc.store');
Route::get('/lophoc/{id}', [LopHocController::class, 'show'])->name('lophoc.show');
Route::get('/lophoc/{id}/sua', [LopHocController::class, 'edit'])->name('lophoc.edit');
Route::put('/lophoc/{id}', [LopHocController::class, 'update'])->name('lophoc.update');
Route::delete('/lophoc/{id}', [LopHocController::class, 'destroy'])->name('lophoc.destroy');


// menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/them', [MenuController::class, 'create'])->name('menu.create');
Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
Route::get('/menu/{id}/sua', [MenuController::class, 'edit'])->name('menu.edit');
Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
