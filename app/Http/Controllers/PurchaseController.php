<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Inertia\Inertia;
use App\Models\Item;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Order::paginate(50));

        $orders = Order::groupBy('id')->selectRaw('id, sum(subTotal) as total,
        customer_name, status, created_at')->paginate(50);

        // dd($orders);

        return Inertia::render('Purchases/Index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::select('id', 'name', 'price')
            ->where('is_selling', true)
            ->get();

        return Inertia::render('Purchases/Create', [
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
        $items = Order::where('id', $purchase->id)->get();
        $order = Order::groupBy('id')
            ->where('id', $purchase->id)
            ->selectRaw('id, sum(subtotal) as total, customer_name, status, created_at')
            ->get();

        return Inertia::render('Purchases/Show', [
            'items' => $items,
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $purchase = Purchase::find($purchase->id);
        // 引数$purchaseのid属性:注文idでPurchaseを1件だけ取得
        $allItems = Item::select('id', 'name', 'price')->get();
        // Itemモデルから、id、name、priceカラムを全件取得
        $items = [];
        // $itemsを空の配列として初期化

        // $allItemsの要素それぞれについて
        foreach ($allItems as $allItem) {
            $quantity = 0;
            // $quantityを0として初期化

            // 取得したpurchaseに属するitemsの要素それぞれについて
            foreach ($purchase->items as $item) {
                if ($allItem->id === $item->id) {
                    $quantity = $item->pivot->quantity;
                }
                // 購入したitemのidに商品のidが一致した場合、
                //  $quantityをその購入でそのitemを購入した個数にする
            }

            array_push($items, [
                'id' => $allItem->id,
                'name' => $allItem->name,
                'price' => $allItem->price,
                'quantity' => $quantity,
            ]);
            // $itemsにこの商品を購入数とともに登録する

        }

        $order = Order::groupBy('id')
            ->where('id', $purchase->id)
            ->selectRaw('id, customer_id, customer_name, status, created_at')
            ->get();

        return Inertia::render('Purchases/Edit', [
            'items' => $items,
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        DB::beginTransaction();

        try {
            // dd($request, $purchase);

            // 中間テーブルの情報を更新 -> sync()

            // 現在のモデルの情報をVueから渡ってきた情報で置き換える。
            // ここで更新するのはstatusのみ
            $purchase->status = $request->status;
            $purchase->save();

            $items = [];

            foreach ($request->items as $item) {
                $items = $items + [
                    $item['id'] => [
                        'quantity' => $item['quantity']
                    ]
                ];
            }
            // dd($items);
            $purchase->items()->sync($items);

            DB::commit();
            return to_route('dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
