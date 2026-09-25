<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\LopHocController;


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


// sinh viên — CRUD đầy đủ
Route::get('/sinhvien', [SinhVienController::class, 'index'])->name('sinhvien.index');
Route::get('/sinhvien/them', [SinhVienController::class, 'create'])->name('sinhvien.create');
Route::post('/sinhvien', [SinhVienController::class, 'store'])->name('sinhvien.store');
Route::get('/sinhvien/{id}/sua', [SinhVienController::class, 'edit'])->name('sinhvien.edit');
Route::put('/sinhvien/{id}', [SinhVienController::class, 'update'])->name('sinhvien.update');
Route::delete('/sinhvien/{id}', [SinhVienController::class, 'destroy'])->name('sinhvien.destroy');


// lớp học — CRUD đầy đủ
Route::get('/lophoc', [LopHocController::class, 'index'])->name('lophoc.index');
Route::get('/lophoc/them', [LopHocController::class, 'create'])->name('lophoc.create');
Route::post('/lophoc', [LopHocController::class, 'store'])->name('lophoc.store');
Route::get('/lophoc/{id}/sua', [LopHocController::class, 'edit'])->name('lophoc.edit');
Route::put('/lophoc/{id}', [LopHocController::class, 'update'])->name('lophoc.update');
Route::delete('/lophoc/{id}', [LopHocController::class, 'destroy'])->name('lophoc.destroy');

