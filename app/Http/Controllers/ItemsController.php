<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

    public function index(Request $request)
    {
        $query = Item::query();
        return response()->json($query->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string',
                'description' => 'nullable|string',
                'code' => 'required|string',
                'status' => 'required|in:active,inactive',
            ],
            [
                'name.required' => 'Please provide a name for the item.',
                'code.required' => 'Item code is required.',
                'status.in' => 'Status must be either active or inactive.',
            ]
        );

        $item = Item::create($validated);

        return response()->json($item, 201);
    }


    public function show($id)
    {
        $item = Item::findOrFail($id);

        return response()->json($item, 200);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'code' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $item->update($validated);

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        Item::findOrFail($id)->delete();

        return response()->json([
            'message' => 'items deleted successfully'
        ], 200);
    }
}
