<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\County;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cities = City::with('county')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            })
            ->when($request->filled('county'), function ($query) use ($request) {
                $query->where('id_county', $request->county);
            })
            ->orderBy('name')
            ->paginate(25)
            ->withQueryString();

        $counties = County::orderBy('name')->get();

        return view('cities.index', compact('cities', 'counties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::orderBy('name')->get();
        return view('cities.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3|max:255',
                'id_county' => 'required|exists:counties,id',
                'zip_code' => 'required|integer',
                'population' => 'required|integer|min:0',
            ],
            ['name.min' => 'A város neve legalább 3 karakter hosszú legyen']);

        City::create($validated);

        return redirect()->route('cities.index')->with('success', 'Város sikeresen létrehozva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::with('county')->findOrFail($id);
        return view('cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        $counties = County::orderBy('name')->get();
        return view('cities.edit', compact('city', 'counties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3|max:255',
                'id_county' => 'required|exists:counties,id',
                'zip_code' => 'required|integer',
                'population' => 'required|integer|min:0',
            ],
            ['name.min' => 'A város neve legalább 3 karakter hosszú legyen.']
        );

        $city = City::findOrFail($id);
        $city->update($validated);

        return redirect()->route('cities.index')->with('success', 'Város sikeresen módosítva.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('cities.index')->with('success', 'Város sikeresen törölve');
    }
}
