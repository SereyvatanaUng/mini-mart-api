<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Shelf;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('shelves')->orderBy('position')->get();
        
        return response()->json([
            'success' => true,
            'data' => $sections
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->user()->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Only shop owners can create sections'
            ], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:sections',
            'description' => 'nullable|string',
            'position' => 'nullable|integer',
        ]);

        $section = Section::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Section created successfully',
            'data' => $section
        ], 201);
    }

    public function show($id)
    {
        $section = Section::with(['shelves', 'products'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $section
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!$request->user()->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Only shop owners can update sections'
            ], 403);
        }

        $section = Section::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:sections,name,' . $section->id,
            'description' => 'nullable|string',
            'position' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $section->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Section updated successfully',
            'data' => $section
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if (!$request->user()->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Only shop owners can delete sections'
            ], 403);
        }

        $section = Section::findOrFail($id);
        
        // Check if section has products
        if ($section->products()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete section with existing products'
            ], 400);
        }

        $section->delete();

        return response()->json([
            'success' => true,
            'message' => 'Section deleted successfully'
        ]);
    }

    // Create shelves for a section
    public function createShelf(Request $request, $sectionId)
    {
        if (!$request->user()->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Only shop owners can create shelves'
            ], 403);
        }

        $section = Section::findOrFail($sectionId);

        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $shelf = Shelf::create([
            'name' => $request->name,
            'section_id' => $section->id,
            'level' => $request->level,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Shelf created successfully',
            'data' => $shelf
        ], 201);
    }
}