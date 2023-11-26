<?php

namespace App\Http\Controllers\Api;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ApplicationCollection;
use App\Http\Requests\ApplicationStoreRequest;
use App\Http\Requests\ApplicationUpdateRequest;

class ApplicationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Application::class);

        $search = $request->get('search', '');

        $applications = Application::search($search)
            ->latest()
            ->paginate();

        return new ApplicationCollection($applications);
    }

    /**
     * @param \App\Http\Requests\ApplicationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationStoreRequest $request)
    {
        $this->authorize('create', Application::class);

        $validated = $request->validated();

        $application = Application::create($validated);

        return new ApplicationResource($application);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Application $application)
    {
        $this->authorize('view', $application);

        return new ApplicationResource($application);
    }

    /**
     * @param \App\Http\Requests\ApplicationUpdateRequest $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicationUpdateRequest $request,
        Application $application
    ) {
        $this->authorize('update', $application);

        $validated = $request->validated();

        $application->update($validated);

        return new ApplicationResource($application);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Application $application)
    {
        $this->authorize('delete', $application);

        $application->delete();

        return response()->noContent();
    }
}
