<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('business_types.index', compact('businessTypes', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', BusinessType::class);

        return view('business_types.create');
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

        return redirect()
            ->route('business-types.edit', $businessType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BusinessType $businessType)
    {
        $this->authorize('view', $businessType);

        return view('business_types.show', compact('businessType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BusinessType $businessType)
    {
        $this->authorize('update', $businessType);

        return view('business_types.edit', compact('businessType'));
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

        return redirect()
            ->route('business-types.edit', $businessType)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('business-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
