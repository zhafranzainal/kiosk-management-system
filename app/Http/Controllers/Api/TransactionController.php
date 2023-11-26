<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;

class TransactionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Transaction::class);

        $search = $request->get('search', '');

        $transactions = Transaction::search($search)
            ->latest()
            ->paginate();

        return new TransactionCollection($transactions);
    }

    /**
     * @param \App\Http\Requests\TransactionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionStoreRequest $request)
    {
        $this->authorize('create', Transaction::class);

        $validated = $request->validated();

        $transaction = Transaction::create($validated);

        return new TransactionResource($transaction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        return new TransactionResource($transaction);
    }

    /**
     * @param \App\Http\Requests\TransactionUpdateRequest $request
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(
        TransactionUpdateRequest $request,
        Transaction $transaction
    ) {
        $this->authorize('update', $transaction);

        $validated = $request->validated();

        $transaction->update($validated);

        return new TransactionResource($transaction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Transaction $transaction)
    {
        $this->authorize('delete', $transaction);

        $transaction->delete();

        return response()->noContent();
    }
}
