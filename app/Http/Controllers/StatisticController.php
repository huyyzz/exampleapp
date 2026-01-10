<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function filter(Request $request){
        
        $start = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end = $request->end_date ?? now()->toDateString();

        $end = date('Y-m-d', strtotime($end . ' +1 day'));

        $revenueStats = Order::selectRaw('DATE(updated_at) as time, SUM(sub_total) as total_subtotal')
            ->whereBetween('updated_at', [$start, $end])
            ->groupBy('time')
            ->orderBy('time')
            ->get();
        // dd($revenueStats);

        $earliest = Order::orderBy('updated_at','asc')->first();
        if ($earliest != null){
            $earliest = $earliest->updated_at;
            $earliest = date('Y-m-d', strtotime($earliest));
        }else{
            $earliest = date('Y-m-d');
        }



        return view('admin.statistic', compact(
            'revenueStats','earliest'
        ));
    }
}
