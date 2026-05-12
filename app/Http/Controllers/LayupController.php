<?php

namespace App\Http\Controllers;

use App\Models\Layup;
use App\Models\Supplier;
use Illuminate\Http\Request;

class LayupController extends Controller
{
    public function index()
    {
        $layups = Layup::with('supplier')->latest()->get();

        return view('layups.index', compact('layups'));
    }

    public function create()
    {
        $suppliers = Supplier::all();

        return view('layups.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        Layup::create($request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'name' => 'required',
            'description' => 'nullable',
        ]));

        return redirect()->route('layups.index');
    }

    public function edit(Layup $layup)
    {
        $suppliers = Supplier::all();

        return view('layups.edit', compact('layup', 'suppliers'));
    }

    public function update(Request $request, Layup $layup)
    {
        $layup->update($request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'name' => 'required',
            'description' => 'nullable',
        ]));

        return redirect()->route('layups.index');
    }

    public function destroy(Layup $layup)
    {
        $layup->delete();

        return redirect()->route('layups.index');
    }
}