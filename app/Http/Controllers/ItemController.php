<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        try {
            $query = Item::query()->with(['brand', 'user']);
            if ($request->has('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            if ($request->has('brand_id')) {
                $query->where('brand_id', $request->brand_id);
            }
            $items = $query
                ->paginate($request->dataTotal ?? 10);
            return response()->json([
                'success' => true,
                'message' => 'Brand list',
                'data' => $items,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Brand gagal ditampilkan',
                'error' => $e->getMessage(),
            ], 500);
        }
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
    public function show(Item $item) {
        $item->load(['brand', 'user']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item) {
        //
    }

    public function userItem(Request $request, $user_id) {
        $search = $request->get('search', '');
        $query = Item::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $searchTerm = '%' . $search . '%';
                $q
                    ->where('name', 'LIKE', $searchTerm)
                    ->orWhere('description', 'LIKE', $searchTerm);
            });
        }
        $data = $query
            ->with(['brand'])
            ->where('user_id', $user_id)
            ->paginate($request->get('dataTotal', 10));
        return response()->json([
            'success' => true,
            'message' => 'Item list',
            'data' => $data
        ], 200);
    }
}
