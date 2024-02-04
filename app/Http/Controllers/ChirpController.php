<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index', [
            // 'chirps' => Chirp::orderBy('created_at', 'desc')->get()
            'chirps' => Chirp::with(['user'])->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255']
        ]);

        // $message = $request->get('message');
        // Insert into database
        // Chirp::create([
        //     'message' => $message,
        //     'user_id' => auth()->id(),
        // ]);

        $request->user()->chirps()->create($validated);

        // session()->flash('status', 'Chirp created successfully');

        return to_route('chirps.index')
            ->with('status', __('Chirp created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        // if (auth()->user()->isNot($chirp->user)) {
        //     abort(403);
        // }

        $this->authorize('update', $chirp);

        return view('chirps.edit', [
            'chirp' => $chirp
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        // if (auth()->user()->isNot($chirp->user)) {
        //     abort(403);
        // }

        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255']
        ]);

        $chirp->update($validated);

        return to_route('chirps.index')
            ->with('status', __('Chirp update successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return to_route('chirps.index')
            ->with('status', __('Chirp delete successfully!'));
    }
}
