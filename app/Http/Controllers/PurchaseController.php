<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::select('id', 'name', 'kana')->get();
        $items = Item::select('id', 'name', 'price')
            ->where('is_selling', true)
            ->get();

        return Inertia::render('Purchases/Create', [
            'customers' => $customers,
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();

        try {

            // Purchaseモデルでインスタンスを新規作成、永続化、インスタンスが結果
            // createの引数は配列で渡す
            $purchase = Purchase::create([
                'customer_id' => $request->customer_id,
                'status' => $request->status,
            ]);

            // 配列itemsでその要素１つずつに対して
            // 上のPurchaseモデルのインスタンスで、1対多のitemsリレーションを介して
            // attachメソッドを使って中間テーブルitem_purchaseに、purchase_id、item_id、quantityをセット
            foreach ($request->items as $item) {
                $purchase->items()->attach($purchase->id, [
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity']
                ]);
            }

        } catch (\Exception $e) {

            DB::rollBack();

        }

        DB::commit();

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
