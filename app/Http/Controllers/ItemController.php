<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return response()->json(
            Item::with('category')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $item = Item::create(
            $request->only('name', 'quantity', 'price', 'category_id')
        );

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Item::with('category')->findOrFail($id);

        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'quantity' => 'sometimes|integer|min:0',
            'price' => 'sometimes|numeric|min:0',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $item->update(
            $request->only('name', 'quantity', 'price', 'category_id')
        );

        return response()->json($item);
    }

    public function destroy($id)
    {
        Item::destroy($id);

        return response()->json(null, 204);
    }
}