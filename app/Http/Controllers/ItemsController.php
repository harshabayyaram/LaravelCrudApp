<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource. - GET at /items
     */
    public function index(Request $request)
    {
        $query = Item::query();
        return response()->json($query->get(), 200);
    }

    /**
     * Show the form for creating a new resource. 
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage. - POST
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string',
                'description' => 'nullable|string',
                'code' => 'required|string|unique:items,code',
                'status' => 'required|in:active,inactive',
            ],
            [
                'name.required' => 'Please provide a name for the item.',
                'code.required' => 'Item code is required.',
                'code.unique' => 'This code already exists. Please use a different code.',
                'status.in' => 'Status must be either active or inactive.',
            ]
        );

        $item = Item::create($validated);

        return response()->json($item, 201);
    }

    /**
     * Display the specified resource. - GET
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);

        return response()->json($item, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(items $item)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage. - PUT
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'code' => 'required|string|unique:items,code,' . $item->id,
            'status' => 'required|in:active,inactive',
        ]);

        $item->update($validated);

        return response()->json($item, 200);
    }

    /**
     * Remove the specified resource from storage. - DELETE
     */
    public function destroy($id)
    {
        Item::findOrFail($id)->delete();

        return response()->json([
            'message' => 'items deleted successfully'
        ], 200);
    }
}
