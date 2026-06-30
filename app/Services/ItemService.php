<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Log;

class ItemService
{
    public function create(array $data)
    {
        $item = Item::create($data);

        Log::info('Item created', [
            'item_id' => $item->id,
            'data' => $data,
        ]);

        return $item;
    }

    public function update(Item $item, array $data)
    {
        $item->update($data);

        Log::info('Item updated', [
            'item_id' => $item->id,
            'data' => $data,
        ]);

        return $item;
    }

    public function delete(Item $item)
    {
        $itemId = $item->id;
        $item->delete();

        Log::info('Item deleted', [
            'item_id' => $itemId,
        ]);

        return true;
    }
}