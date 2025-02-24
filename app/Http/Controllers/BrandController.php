<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller {

    public function index(Request $request) {
        $search = $request->get('search', '');
        $query = Brand::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $searchTerm = '%' . $search . '%';
                $q->where('name', 'LIKE', $searchTerm);
            });
        }
        $data = $query->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Brand list',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand) {
        //
    }
}
