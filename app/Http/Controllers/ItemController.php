<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Item;


class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }


    public function store(Request $request)
    {
        $item = new Item([
          'title' => $request->get('title'),
          'amount' => $request->get('amount'),
          'stocked' => $request->get('stocked'),
        ]);
        $item->save();


        return response()->json('Item Added Successfully.');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->title = $request->get('title');
        $item->amount = $request->get('amount');
        $item->stocked = $request->get('stocked');
        $item->save();


        return response()->json('Item Updated Successfully.');
    }

    public function destroy($id)
    {
      $item = Item::find($id);
      $item->delete();


      return response()->json('Item Deleted Successfully.');
    }
}
