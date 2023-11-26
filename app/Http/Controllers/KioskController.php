<?php

namespace App\Http\Controllers;

use App\Models\Kiosk;
use Illuminate\Http\Request;
use App\Models\BusinessType;
use App\Http\Requests\KioskStoreRequest;
use App\Http\Requests\KioskUpdateRequest;

class KioskController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Kiosk::class);

        $search = $request->get('search', '');

        $kiosks = Kiosk::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.kiosks.index', compact('kiosks', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Kiosk::class);

        $businessTypes = BusinessType::pluck('name', 'id');

        return view('app.kiosks.create', compact('businessTypes'));
    }

    /**
     * @param \App\Http\Requests\KioskStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KioskStoreRequest $request)
    {
        $this->authorize('create', Kiosk::class);

        $validated = $request->validated();

        $kiosk = Kiosk::create($validated);

        return redirect()
            ->route('kiosks.edit', $kiosk)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kiosk $kiosk
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Kiosk $kiosk)
    {
        $this->authorize('view', $kiosk);

        return view('app.kiosks.show', compact('kiosk'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kiosk $kiosk
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Kiosk $kiosk)
    {
        $this->authorize('update', $kiosk);

        $businessTypes = BusinessType::pluck('name', 'id');

        return view('app.kiosks.edit', compact('kiosk', 'businessTypes'));
    }

    /**
     * @param \App\Http\Requests\KioskUpdateRequest $request
     * @param \App\Models\Kiosk $kiosk
     * @return \Illuminate\Http\Response
     */
    public function update(KioskUpdateRequest $request, Kiosk $kiosk)
    {
        $this->authorize('update', $kiosk);

        $validated = $request->validated();

        $kiosk->update($validated);

        return redirect()
            ->route('kiosks.edit', $kiosk)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kiosk $kiosk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Kiosk $kiosk)
    {
        $this->authorize('delete', $kiosk);

        $kiosk->delete();

        return redirect()
            ->route('kiosks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
