<?php

namespace App\Http\Controllers;

use App\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('index.list_floor');
        $obj = Floor::all();
        return view('pages.floor.index', compact('obj', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = __('index.add_floor');
        return view('pages.floor.addEditFloor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:tbl_floors',
            'description' => 'nullable',
        ]);

        Floor::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('floor.index')->with(saveMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Floor';
        $obj = Floor::find(encrypt_decrypt($id, 'decrypt'));
        return view('pages.floor.addEditFloor', compact('obj', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $floor = Floor::find($id);
        $floor->name = $request->name;
        $floor->description = $request->description;
        $floor->save();

        return redirect()->route('floor.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $currency = Floor::find($id);
        $currency->del_status = 'Deleted';
        $currency->save();
        return redirect()->route('floor.index')->with(deleteMessage());
    }
}
