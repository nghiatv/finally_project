<?php

namespace App;

use Carbon\Carbon;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Database\Eloquent\Model;
use App\POheader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Cast\Array_;

//use Illuminate\Support\Facades\DB as DB;
class Store extends Model
{
    protected $fillable = ['store_name', 'store_phone', 'store_email', 'store_description', 'control_code'];

    static function getLatestOrders($id, $num)
    {
        $store = Store::findOrFail($id);
        $orders = POheader::where('store_id', '=', $store->id)->orderBy('order_date', 'desc')->take($num)->get();
        return $orders;
    }

    static function getBestSelling($id, $day = 0)
    {
        if ($day == 0) {
            $bestselling = DB::table('purchase_order_details')
                ->join('purchase_order_headers', 'purchase_order_details.po_id', '=', 'purchase_order_headers.id')
                ->join('products', 'purchase_order_details.pid', '=', 'products.id')
                ->where('purchase_order_headers.store_id', '=', $id)
                ->select('pid', DB::raw('sum(quantity) as quantity'), 'products.product_name')
                ->groupBy('pid')
                ->orderBy('quantity', 'desc')
                ->limit(1)
                ->get();
        } else {
            $today = date('Y-m-d H:i:s', time() + 86400 );
            $day = time() - $day * 86400;
            $date = date('Y-m-d H:i:s', $day);
            $bestselling = DB::table('purchase_order_details')
                ->join('purchase_order_headers', 'purchase_order_details.po_id', '=', 'purchase_order_headers.id')
                ->join('products', 'purchase_order_details.pid', '=', 'products.id')
                ->where('purchase_order_headers.store_id', '=', $id)
                ->whereBetween('purchase_order_headers.order_date', [$date, $today])
                ->select('pid', DB::raw('sum(quantity) as quantity'), 'products.product_name')
                ->groupBy('pid')
                ->orderBy('quantity', 'desc')
                ->limit(1)
                ->get();
        }

        return $bestselling;
    }

    static function getRevenue($id, $begin = 0, $end = 0)
    {
        $store = Store::findOrFail($id);
        if ($store) {
            if ($begin == 0 && $end == 0) {
                $end = date('Y-m-d H:i:s', time());
                $begin = date('Y-m-d H:i:s', time() - 30 * 86400);
                $revenue = DB::table('purchase_order_headers')
                    ->where('purchase_order_headers.store_id', '=', $id)
                    ->whereBetween('purchase_order_headers.order_date', [$begin, $end])
                    ->select(DB::raw('SUM(amount) as amount'))
                    ->get();
//                dd($revenue);
            } else {

                $revenue = DB::table('purchase_order_headers')
                    ->where('purchase_order_headers.store_id', '=', $id)
                    ->whereBetween('purchase_order_headers.order_date', [$begin, $end])
                    ->select(DB::raw('SUM(amount) as amount'))
                    ->get();
            }
            return $revenue;
        } else
            return response()->json('Not found');
    }

    static function getNewOrders($id, $begin = 0, $end = 0)
    {
        if ($begin == 0 && $end == 0) {
            $neworders = DB::table('purchase_order_headers')->where('purchase_order_headers.store_id', '=', $id)
                ->select(DB::raw('count(*) as orders_count'))->get();
        } else {
            $neworders = DB::table('purchase_order_headers')->where('purchase_order_headers.store_id', '=', $id)
                ->whereBetween('purchase_order_headers.order_date', [$begin, $end])
                ->select(DB::raw('count(*) as orders_count'))->get();
        }
        return $neworders;
    }

    static function getRevenueInLastMonth($id)
    {

        $store = Store::findOrFail($id);

        if ($store) {
            $today = time();
            $listRevenue = [];

            for ($x = 0; $x <= 30; $x++) {
                $day = date('Y-m-d', $today - $x * 86400);
                $profit = self::getRevenueInDay($id, $today - $x * 86400);
                $item = [$day, $profit[0]];
                array_push($listRevenue, $item);
            }
//            dd($listRevenue);
            return $listRevenue;
        } else
            return response()->json('Not Found', 404);

    }

    static function getRevenueInDay($id, $timestamp)
    {

        $store = Store::findOrFail($id);
        if ($store) {
            $begin = date('Y-m-d H:i:s', $timestamp);
            $end = $timestamp + 86399;
            $end = date('Y-m-d H:i:s', $end);
//            dd($begin." ".$end  )   ;
            $revenueInDay = DB::table('purchase_order_headers')
                ->whereBetween('purchase_order_headers.order_date', [new Carbon($begin), new Carbon($end)])
                ->where('purchase_order_headers.store_id', '=', $id)
                ->select(DB::raw('SUM(amount) as total_amount '))
                ->get();
//            dd($revenueInDay);
            return $revenueInDay;

        }
//        return $timestamp;

    }

    public static function getTotalRevenue($begin = 0, $end = 0)
    {
        if ($begin == 0 && $end == 0) {
            $begin = date('Y-m-d H:i:s', time() - 30 * 86400);
            $end = date('Y-m-d H:i:s', time() + 86400);
            try {
                $revenue = DB::table('purchase_order_headers')->whereBetween('purchase_order_headers.order_date', [$begin, $end])
                    ->select(DB::raw('SUM(amount) as amount'))->get();
            } catch (\Exception $e) {
                return Redirect::to('/admin')->with('msg', 'Có gì đó không đúng. Hãy thử lại ' . $e->getMessage());
            }
        } else {
            if ($begin > $end || $begin < 0 || $end < 0) {
                return response()->json('Wrong input');
            } else {
                try {
                    $revenue = DB::table('purchase_order_headers')->whereBetween('purchase_order_headers.order_date', [$begin, $end])
                        ->select(DB::raw('SUM(amount) as amount'))->get();
                } catch (\Exception $e) {
                    return Redirect::to('/admin')->with('msg', 'Có gì đó không đúng. Hãy thử lại ' . $e->getMessage());
                }
            }
        }
        return $revenue;
    }

    public static function getTotalSales($begin = 0, $end = 0)
    {
        $sales_num = 0;
        if ($begin == 0 && $end == 0) {
            $begin = date('Y-m-d H:i:s', time() - 30 * 86400);
            $end = date('Y-m-d H:i:s', time() + 86400);
            try {
                $sales = DB::table('purchase_order_headers')->whereBetween('purchase_order_headers.order_date', [$begin, $end])->get();

                $sales_num = count($sales);
            } catch (\Exception $e) {
                return Redirect::to('/')->with('msg', 'Có gì đó không đúng. Hãy xem lại' . $e->getMessage());
            }
        } else {
            try {
                $sales = DB::table('purchase_order_headers')->whereBetween('purchase_order_headers.order_date', [$begin, $end])->get();
                $sales->num = count($sales);
            } catch (\Exception $e) {
                return Redirect::to('admin/store')->with('msg', 'Có gì đó sai sai. Hãy thử lại' . $e->getMessage());
            }
        }
        return $sales_num;
    }

    public static function getTotalRevenueByMonth()
    {
        $time = [];
        $year = date('Y', time());
        for ($i = 0; $i < 12; $i++) {
            $month = $year . "-" . ($i + 1) . "-1";
            $month_start = strtotime($month);
            $month_end = strtotime('last day of this month', $month_start);
            $month_start = date('Y-m-d H:i:s',$month_start);
            $month_end = date('Y-m-d H:i:s',$month_end);

            try {

                $revenue = DB::table('purchase_order_headers')->whereBetween('purchase_order_headers.order_date', [$month_start, $month_end])
                    ->select(DB::raw('SUM(amount) as amount'))->get();
//                array_push($time,$revenue[0]->amount);

                $item = [($i+1),$revenue[0]->amount];
                array_push($time,$item);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }
        return $time;
    }
}
