<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return response()->json(Item::with('Location','Category')->get());
    }

    public function store(Request $request)
    {

        Item::create([
            'name'          => $request->input('name'),
            'category_id'   => $request->input('category'),
            'location_id'   => $request->input('location'),
            'price'         => $request->input('price'),
        ]);
    }

    public function update(Request $request)
    {
        $item = Item::find($request->id);
        $item->price = $request->price;
        $item->save();

    }

    public function destroy(Item $item)
    {
        $item->delete();
    }
}
