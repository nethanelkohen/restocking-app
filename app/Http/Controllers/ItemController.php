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

  public function stock($id)
  {
    $item = Item::find($id);
    $item->stocked = true;
    $item->save();

    return response()->json([
     "code" => 200,
     "message" => "Item listed as stocked"
    ]);
  }

  public function restock($id)
  {
    $item = Item::find($id);
    $item->stocked = false;
    $item->save();

    return response()->json([
     "code" => 200,
     "message" => "Item listed as needed to restock"
    ]);
  }

  public function edit($id)
    {
        // get the nerd
    $item = Item::find($id);

        // show the edit form and pass the nerd
    return response()->json([
     "code" => 200,
     "message" => "Item listed as completed"
    ]);
  }

  public function update(Request $request){
    $item = Item::find($request->id);
    $item->item = $request->item;
    $item->amount = $request->amount;
    $item->save();

    $items = Item::orderBy('id','DESC')->get();

    return response()->json(['items'=>$items]);
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
