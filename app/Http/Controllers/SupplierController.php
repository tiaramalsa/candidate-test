<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Layup;
use App\Models\Layer;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        Supplier::create($request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]));

        return redirect()->route('suppliers.index')
        ->with('success', 'Supplier created successfully');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]));

        return redirect()->route('suppliers.index')
        ->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')
        ->with('success', 'Supplier deleted successfully');
    }

    public function export(Supplier $supplier)
    {
        $supplier->load('layups.layers');

        $fileName = 'supplier-' . $supplier->id . '.json';

        return response()->streamDownload(
            function () use ($supplier) {
                echo json_encode(
                    $supplier,
                    JSON_PRETTY_PRINT
                );
            },
            $fileName
        );
    }

    public function importForm()
    {
        return view('suppliers.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'json_file' => 'required|file|mimes:json',
            'strategy' => 'required|in:overwrite,skip',
        ]);

        $strategy = $request->strategy;

        $json = file_get_contents(
            $request->file('json_file')->getRealPath()
        );

        $data = json_decode($json, true);

        $created = 0;
        $updated = 0;
        $skipped = 0;

        $supplier = Supplier::firstOrCreate(
            [
                'name' => $data['name'],
            ],
            [
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
            ]
        );

        foreach ($data['layups'] as $layupData) {

            $layup = Layup::firstOrCreate(
                [
                    'supplier_id' => $supplier->id,
                    'name' => $layupData['name'],
                ],
                [
                    'description' => $layupData['description'] ?? null,
                ]
            );

            foreach ($layupData['layers'] as $layerData) {

                $existingLayer = Layer::where(
                    'layup_id',
                    $layup->id
                )
                ->where(
                    'layer_order',
                    $layerData['layer_order']
                )
                ->first();

                if ($existingLayer) {

                    $isConflict =
                        $existingLayer->thickness != $layerData['thickness']
                        || $existingLayer->width != $layerData['width']
                        || $existingLayer->angle != $layerData['angle'];

                    if ($isConflict) {

                        if ($strategy === 'overwrite') {

                            $existingLayer->update([
                                'thickness' => $layerData['thickness'],
                                'width' => $layerData['width'],
                                'angle' => $layerData['angle'],
                            ]);

                            $updated++;
                        }

                        if ($strategy === 'skip') {

                            $skipped++;

                            continue;
                        }
                    }

                } else {

                    Layer::create([
                        'layup_id' => $layup->id,
                        'layer_order' => $layerData['layer_order'],
                        'thickness' => $layerData['thickness'],
                        'width' => $layerData['width'],
                        'angle' => $layerData['angle'],
                    ]);

                    $created++;
                }
            }
        }

        $message = "
            Import completed successfully.
            {$created} new data created,
            {$updated} existing data updated,
            {$skipped} duplicate data skipped.
        ";

        return redirect()
            ->route('suppliers.index')
            ->with('success', $message);
    }
}