<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return View("services.index",[
            'services'=>Service::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        // https://laravel.com/docs/10.x/validation#available-validation-rules
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'basePrice_cents' => 'integer|gte:0',
            'duration_minutes' => 'integer|gte:0',
            'description' => 'nullable|string',
        ]);
        $service = Service::create($validated);
        $service->save();

        return redirect(route('services.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service): View
    {
        //TODO Authorization
        //$this->authorize('update',$service);

        return view('services.edit',[
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service):RedirectResponse
    {
        //TODO Authorization - https://bootcamp.laravel.com/blade/editing-chirps#authorization
        //$this->authorize('update', $chirp);

        //TODO move validation logic so not duplicated - https://laravel.com/docs/validation#form-request-validation
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'basePrice_cents' => 'integer|gte:0',
            'duration_minutes' => 'integer|gte:0',
            'description' => 'nullable|string',
        ]);

        $service->update($validated);

        return redirect(route('services.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
