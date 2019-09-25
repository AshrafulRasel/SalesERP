<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:suppliers|regex:/^[a-zA-Z ]+$/',
            'address' => 'required|min:3',
            'mobile' => 'required|min:3|digits:11',
            'details' => 'required|min:3|',
            'previous_balance' => 'min:3',

        ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->mobile = $request->mobile;
        $supplier->details = $request->details;
        $supplier->previous_balance = $request->previous_balance;
        $supplier->save();

        return redirect()->back()->with('message', 'Supplier Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
            'address' => 'required|min:3',
            'mobile' => 'required|min:3|digits:11',
            'details' => 'required|min:3|',
            'previous_balance' => 'min:3',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->mobile = $request->mobile;
        $supplier->details = $request->details;
        $supplier->previous_balance = $request->previous_balance;
        $supplier->save();

        return redirect()->back()->with('message', 'Suppler Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->back();

    }
}
