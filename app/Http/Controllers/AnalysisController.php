<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    public function index()
    {



        return Inertia::render('Analysis');
    }

    public function decile()
    {
        $startDate = '2023-08-29';
        $endDate = '2023-08-31';

        $subQuery = Order::betweenDate($startDate, $endDate)
            ->groupBy('id')
            ->selectRaw('id, customer_id, customer_name, SUM(subtotal) as totalPerPurchase');

        $subQuery = DB::table($subQuery)
            ->groupBy('customer_id')
            ->selectRaw('customer_id, customer_name, sum(totalPerPurchase) as total')
            ->orderBy('total', 'desc');

        DB::statement('set @row_num = 0;');
        $subQuery = DB::table($subQuery)
            ->selectRaw('@row_num:=@row_num+1 as row_num,
                    customer_id, customer_name, total');

        $count = DB::table($subQuery)->count();
        $total = DB::table($subQuery)->selectRaw('sum(total) as total')->get();
        $total = $total[0]->total;

        $decile = ceil($count / 10);

        $bindValues = [];
        $tempValue = 0;

        for ($i = 1; $i <= 10; $i++) {
            array_push($bindValues, 1 + $tempValue);
            $tempValue += $decile;
            array_push($bindValues, 1 + $tempValue);
        }

        DB::statement('set @row_num = 0;');
        $subQuery = DB::table($subQuery)
            ->select(['row_num', 'customer_id', 'customer_name', 'total'])
            ->selectRaw('NTILE(10) OVER (ORDER BY row_num) as decile');

        $subQuery = DB::table($subQuery)
            ->groupBy('decile')
            ->selectRaw('decile, round(avg(total)) as average, sum(total) as totalPerGroup');

        DB::statement("set @total = {$total} ;");
        $data = DB::table($subQuery)
            ->selectRaw('decile, average, totalPerGroup, round(100 * totalPerGroup / @total, 1) as totalRatio')
            ->get();
    }
}
