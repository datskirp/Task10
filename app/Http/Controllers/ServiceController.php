<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-service');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request, Service $service)
    {
        $validated = $request->validated();
        $service->fill($validated)->save();

        return redirect(route('admin.services.index'))->with('success', 'Service was created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Service $services
     */
    public function edit(Service $services, $id)
    {
        $service = $services->where('id', $id)->firstOrFail();

        return view('edit-service', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Service      $service
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $validated = $request->validated();
        $service->where('id', $validated['id'])->update($validated);

        return redirect(route('admin.services.index'))->with(
            'success',
            sprintf(
                'Service with id: %s was updated',
                $request->input('id'),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Service $services
     */
    public function destroy(Service $services, $id)
    {
        $services->where('id', $id)->firstOrFail()->delete();

        return redirect(route('admin.services.index'))->with(
            'success',
            sprintf(
                'Service with id: %s was deleted',
                $id,
            )
        );
    }
}
