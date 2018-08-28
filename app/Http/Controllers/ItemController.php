<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
 {
  public function index()
  {
    $items = Item::where("stocked", false)->orderBy("id", "DEC")->get();
    $s_items = Item::where("stocked", true)->get();
    return response()->json([
     'items' => $items,
     's_items' => $s_items
    ]);
  }

  public function store(Request $request)
   {

    $item = Item::create([
    'item' => request('item'),
    'stocked' => request('stocked'),
    'amount' => request('amount')
    ]);

    return response()->json([
     "code" => 200,
     "message" => "Item added successfully"
    ]);
  }

  public function complete($id)
  {
    $item = Item::find($id);
    $item->stocked = true;
    $item->save();
    return response()->json([
     "code" => 200,
     "message" => "Item listed as completed"
    ]);
  }

  public function destroy($id)
  {
    $item = Item::find($id);
    $item = $item->delete();
    return response()->json([
    "code" => 200,
    "message" => "Item deleted successfully"
   ]);
 }
}
