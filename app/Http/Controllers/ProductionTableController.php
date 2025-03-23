<?php

namespace App\Http\Controllers;

use App\Floor;
use App\ProductionTable;
use Illuminate\Http\Request;

class ProductionTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = __('index.list_production_table');
        $obj = ProductionTable::all();
        return view('pages.production_table.index', compact('obj', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = __('index.add_production_table');
        $floors = Floor::all();
        return view('pages.production_table.addEditProductionTable',compact('floors'));
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
            'table_name' => 'required',
            'floor_id' => 'required|exists:tbl_floors,id',
            'number_of_seats' => 'required|integer',
            'description' => 'nullable'
        ]);

        ProductionTable::create([
            'table_name' =>  $request->table_name,
            'floor_id' =>  $request->floor_id,
            'number_of_seats' =>  $request->number_of_seats,
            'description' =>  $request->description
        ]);

        return redirect()->route('production_table.index')->with(saveMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductionTable  $productionTable
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionTable $productionTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductionTable  $productionTable
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = 'Edit ProductionTable';
        $obj = ProductionTable::find(encrypt_decrypt($id, 'decrypt'));
        $floors = Floor::all();
        return view('pages.production_table.addEditProductionTable', compact('obj', 'title','floors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductionTable  $productionTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $request->validate([
            'table_name' => 'required',
            'floor_id' => 'required|exists:tbl_floors,id',
            'number_of_seats' => 'required|integer',
            'description' => 'nullable'
        ]);


        $ProductionTable = ProductionTable::find($id);
        $ProductionTable->table_name = $request->table_name;
        $ProductionTable->floor_id = $request->floor_id;
        $ProductionTable->number_of_seats = $request->number_of_seats;
        $ProductionTable->description = $request->description;
        $ProductionTable->save();

        return redirect()->route('production_table.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductionTable  $productionTable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $production_able = ProductionTable::find($id);
        $production_able->delete();
        return redirect()->route('production_table.index')->with(deleteMessage());
    }
}
