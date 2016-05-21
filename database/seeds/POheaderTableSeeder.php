<?php

use Illuminate\Database\Seeder;
use App\POheader;
use Illuminate\Database\Eloquent\Model;

class POheaderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $int = mt_rand(time() - 86400*10,time()- 86400*2);
        $date = date("Y-m-d H:i:s",$int);
        $seller = 'Nhân viên - '.random_int(1,3);
        $ship_cost = random_int(10,50)*1000;
        $tax_cost = random_int(1,4)*1000;
        $discount = random_int(1,20)*1000;
        $total_duel = $ship_cost + $tax_cost + $discount;
        $po_name = "Bill - ".random_int(1,100);
        $purchases = array(
            [
                'store_id' => 5,
                'seller' => $seller,
                'ship_id' => 1,
                'ship_cost' => $ship_cost,
                'order_date' => $date,
                'tax_cost' => $tax_cost,
                'discount' => $discount,
                'total_duel' => $total_duel,
                'amount' => '50000',
                'purchase_order_name' => $po_name,
                'customer_id' => 3,
            ]

        );
        foreach ($purchases as $purchase) {
//            dd(var_dump($product));
            POheader::create($purchase);

        }
        Model::reguard();
        //
    }
}
