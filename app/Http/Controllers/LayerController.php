<?php

namespace App\Http\Controllers;

use App\Models\Layer;
use App\Models\Layup;
use Illuminate\Http\Request;

class LayerController extends Controller
{
    public function index()
    {
        $layers = Layer::with('layup')->latest()->get();

        return view('layers.index', compact('layers'));
    }

    public function create()
    {
        $layups = Layup::all();

        return view('layers.create', compact('layups'));
    }

    public function store(Request $request)
    {
        Layer::create($request->validate([
            'layup_id' => 'required|exists:layups,id',
            'layer_order' => 'required|integer',
            'thickness' => 'required|numeric',
            'width' => 'required|numeric',
            'angle' => 'required|numeric',
        ]));

        return redirect()->route('layers.index')
        ->with('success', 'Layer created successfully');
    }

    public function edit(Layer $layer)
    {
        $layups = Layup::all();

        return view('layers.edit', compact('layer', 'layups'));
    }

    public function update(Request $request, Layer $layer)
    {
        $layer->update($request->validate([
            'layup_id' => 'required|exists:layups,id',
            'layer_order' => 'required|integer',
            'thickness' => 'required|numeric',
            'width' => 'required|numeric',
            'angle' => 'required|numeric',
        ]));

        return redirect()->route('layers.index')
        ->with('success', 'Layer updated successfully');
    }

    public function destroy(Layer $layer)
    {
        $layer->delete();

        return redirect()->route('layers.index')
        ->with('success', 'Layer deleted successfully');
    }
}