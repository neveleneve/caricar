<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function index(Request $request) {
        $search = $request->get('search', '');
        $query = User::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $searchTerm = '%' . $search . '%';
                $q
                    ->where('name', 'LIKE', $searchTerm)
                    ->orWhere('email', 'LIKE', $searchTerm);
            });
        }
        $data = $query
            ->with('roles')
            ->paginate($request->get('dataTotal', 10));
        return response()->json([
            'success' => true,
            'message' => 'User list',
            'data' => $data
        ], 200);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(User $pengguna) {
        $pengguna->load('roles');
        return response()->json([
            'success' => true,
            'message' => 'User detail',
            'data' => $pengguna
        ], 200);
    }

    public function edit(string $id) {
        //
    }

    public function update(Request $request, string $id) {
        //
    }

    public function destroy(string $id) {
        //
    }
}
