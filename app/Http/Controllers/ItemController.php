<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|integer'
        ]);

        $query = Item::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
{
    dd($request->all());

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

        $item = $this->itemService->update(
            $item,
            $request->only('name', 'quantity', 'price', 'category_id')
        );

        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        $this->itemService->delete($item);

        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }
}