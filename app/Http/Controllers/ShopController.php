<?php

namespace App\Http\Controllers;

use App\Models\claimedItem;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index() {
        $items = ShopItem::all();
        return view('registered.shop', compact('items'));
    }

    public function claim(Request $request, $itemId)
    {
        $user = Auth::user();
        $item = ShopItem::findOrFail($itemId);

        if ($user->member->memberPoints < $item->price) {
            return redirect()->back()->with('error', 'Not enough points to claim this item.');
        }

        $user->member->memberPoints -= $item->price;
        $user->member->save();

        DB::table('claimed_items')->insert([
            'userId' => $user->userId,
            'itemId' => $item->itemId,
        ]);


        return redirect()->route('shop.index')->with('success', 'Item successfully claimed!');
    }
}
