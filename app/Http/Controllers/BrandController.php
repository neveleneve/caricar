<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Exception;
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
        $data = $query
            ->withTrashed()
            ->orderBy('deleted_at')
            ->paginate($request->get('dataTotal', 10));
        return response()->json([
            'success' => true,
            'message' => 'Brand list',
            'data' => $data
        ], 200);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $brand = Brand::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Data Brand berhasil dibuat',
                'data' => $brand,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Brand gagal dibuat',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Brand $brand) {
        return response()->json([
            'success' => true,
            'message' => 'Brand detail',
            'data' => $brand
        ], 200);
    }

    public function edit(Brand $brand) {
        //
    }

    public function update(Request $request, Brand $brand) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $brand->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Brand updated successfully',
            'data' => $brand
        ], 200);
    }

    public function destroy($brand) {
        $data = Brand::withTrashed()->find($brand);
        if ($data->trashed()) {
            $data->restore();
            return response()->json([
                'success' => true,
                'message' => 'Data Brand Berhasil Dipulihkan'
            ], 200);
        }
        try {
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data Brand Berhasil Dihapus'
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Brand gagal dihapus',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
