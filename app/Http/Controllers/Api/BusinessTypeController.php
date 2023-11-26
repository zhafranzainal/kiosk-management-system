<?php

namespace App\Http\Controllers\Api;

use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BusinessTypeResource;
use App\Http\Resources\BusinessTypeCollection;
use App\Http\Requests\BusinessTypeStoreRequest;
use App\Http\Requests\BusinessTypeUpdateRequest;

class BusinessTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', BusinessType::class);

        $search = $request->get('search', '');

        $businessTypes = BusinessType::search($search)
            ->latest()
            ->paginate();

        return new BusinessTypeCollection($businessTypes);
    }

    /**
     * @param \App\Http\Requests\BusinessTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessTypeStoreRequest $request)
    {
        $this->authorize('create', BusinessType::class);

        $validated = $request->validated();

        $businessType = BusinessType::create($validated);

        return new BusinessTypeResource($businessType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BusinessType $businessType)
    {
        $this->authorize('view', $businessType);

        return new BusinessTypeResource($businessType);
    }

    /**
     * @param \App\Http\Requests\BusinessTypeUpdateRequest $request
     * @param \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function update(
        BusinessTypeUpdateRequest $request,
        BusinessType $businessType
    ) {
        $this->authorize('update', $businessType);

        $validated = $request->validated();

        $businessType->update($validated);

        return new BusinessTypeResource($businessType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BusinessType $businessType)
    {
        $this->authorize('delete', $businessType);

        $businessType->delete();

        return response()->noContent();
    }
}
