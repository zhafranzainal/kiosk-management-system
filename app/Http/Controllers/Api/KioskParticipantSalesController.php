<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\KioskParticipant;
use App\Http\Resources\SaleResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleCollection;

class KioskParticipantSalesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KioskParticipant $kioskParticipant
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, KioskParticipant $kioskParticipant)
    {
        $this->authorize('view', $kioskParticipant);

        $search = $request->get('search', '');

        $sales = $kioskParticipant
            ->sales()
            ->search($search)
            ->latest()
            ->paginate();

        return new SaleCollection($sales);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KioskParticipant $kioskParticipant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, KioskParticipant $kioskParticipant)
    {
        $this->authorize('create', Sale::class);

        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
        ]);

        $sale = $kioskParticipant->sales()->create($validated);

        return new SaleResource($sale);
    }
}
