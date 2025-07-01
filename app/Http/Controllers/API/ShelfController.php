<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    public function index(Request $request)
    {
        $query = Shelf::with('section');

        if ($request->has('section_id')) {
            $query->where('section_id', $request->section_id);
        }

        $shelves = $query->orderBy('section_id')->orderBy('level')->get();
        
        return response()->json([
            'success' => true,
            'data' => $shelves
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->user()->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Only shop owners can create shelves'
            ], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id',
            'level' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $shelf = Shelf::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Shelf created successfully',
            'data' => $shelf->load('section')
        ], 201);
    }

    public function show($id)
    {
        $shelf = Shelf::with(['section', 'products'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $shelf
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!$request->user()->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Only shop owners can update shelves'
            ], 403);
        }

        $shelf = Shelf::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id',
            'level' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $shelf->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Shelf updated successfully',
            'data' => $shelf->load('section')
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if (!$request->user()->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Only shop owners can delete shelves'
            ], 403);
        }

        $shelf = Shelf::findOrFail($id);
        
        // Check if shelf has products
        if ($shelf->products()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete shelf with existing products'
            ], 400);
        }

        $shelf->delete();

        return response()->json([
            'success' => true,
            'message' => 'Shelf deleted successfully'
        ]);
    }
}
