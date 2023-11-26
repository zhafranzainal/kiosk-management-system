<?php

namespace App\Http\Controllers\Api;

use App\Models\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KioskResource;
use App\Http\Resources\KioskCollection;
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
            ->paginate();

        return new KioskCollection($kiosks);
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

        return new KioskResource($kiosk);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kiosk $kiosk
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Kiosk $kiosk)
    {
        $this->authorize('view', $kiosk);

        return new KioskResource($kiosk);
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

        return new KioskResource($kiosk);
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

        return response()->noContent();
    }
}
