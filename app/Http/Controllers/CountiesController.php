<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $counties = County::withSum('cities', 'population')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('name')
            ->get();

        return view('counties.index', compact('counties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('counties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3|max:255',
                'badge' => 'nullable|string|max:255',
            ],
            ['name.min' => 'A megye neve legalább 3 karakter hosszú legyen']);

        County::create($validated);

        return redirect()->route('counties.index')->with('success', 'Megye sikeresen létrehozva.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $county = County::withSum('cities', 'population')->findOrFail($id);
        $cities = $county->cities()->orderBy('name')->paginate(25);

        return view('counties.show', compact('county', 'cities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $county = County::findOrFail($id);
        return view('counties.edit', compact('county'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3|max:255',
                'badge' => 'nullable|string|max:255',
            ],
            ['name.min' => 'A megye neve legalább 3 karakter hosszú legyen.']
        );

        $county = County::findOrFail($id);
        $county->update($validated);

        return redirect()->route('counties.index')->with('success', 'Megye sikeresen módosítva.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $county = County::findOrFail($id);

        if ($county->cities()->exists()) {
            return redirect()->route('counties.index')->with('error', 'A megye nem törölhető, mert vannak hozzá rendelt városok.');
        }

        $county->delete();

        return redirect()->route('counties.index')->with('success', 'Megye sikeresen törölve');
    }
}
