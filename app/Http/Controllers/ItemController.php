<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items[] = Item::where('completed', false)->orderBy('created_at', 'DESC')->get();

        $items[] = Item::where('completed', true)->orderBy('created_at', 'DESC')->get();

        $items[] = Item::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();

        //sleep(10);
        return $items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Item::create([
            'name' => $request->item['name'],
        ]);
        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        if (isset($request->item['name'])) {
            $item->name = $request->item['name'];    
        }
        $item->completed = $request->item['completed'] ? true : false;
        $item->completed_at = $request->item['completed'] ? now() : null;
        $item->save();
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if ($item->delete()) {
            return "Item deleted successfully.";
        }
        return "Failed to delete item.";
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = Item::onlyTrashed()->findOrFail($id);        
        if ($item->restore()) {
            return "Item restored successfully.";
        }
        return "Failed to restore item.";
    }
}
