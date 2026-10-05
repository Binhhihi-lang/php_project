<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LopHoc;
use App\Http\Resources\LopHocResource;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class LopHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use ApiResponse;

    public function index()
    {
        //
        return $this->success(LopHocResource::collection(LopHoc::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LopHoc $lopHoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LopHoc $lopHoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LopHoc $lopHoc)
    {
        //
    }
}
