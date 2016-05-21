<?php

use Illuminate\Database\Seeder;
use App\POdetail;
use Illuminate\Database\Eloquent\Model;
class POdetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $items = array(
            ['po_id' => 88,'pid' => random_int(1,25),'unit_price' => random_int(5,30)*1000,'quantity' => random_int(1,10)],
            ['po_id' => 88,'pid' => random_int(1,25),'unit_price' => random_int(10,30)*500,'quantity' => random_int(1,10)],
            ['po_id' => 90,'pid' => random_int(1,25),'unit_price' => random_int(1,20)*1000,'quantity' => random_int(1,10)],
            ['po_id' => 89,'pid' => random_int(1,25),'unit_price' => random_int(1,30)*1000,'quantity' => random_int(1,10)],
            ['po_id' => 89,'pid' => random_int(1,25),'unit_price' => random_int(1,30)*1000,'quantity' => random_int(1,10)],
            ['po_id' => 88,'pid' => random_int(1,25),'unit_price' => random_int(1,30)*1000,'quantity' => random_int(1,10)],
            ['po_id' => 89,'pid' => random_int(1,25),'unit_price' => random_int(1,30)*1000,'quantity' => random_int(1,10)],
            ['po_id' => 90,'pid' => random_int(1,25),'unit_price' => random_int(1,30)*1000,'quantity' => random_int(1,10)],
            ['po_id' => 88,'pid' => random_int(1,25),'unit_price' => random_int(1,30)*1000,'quantity' => random_int(1,10)],
            ['po_id' => 90,'pid' => random_int(1,25),'unit_price' => random_int(1,30)*1000,'quantity' => random_int(1,10)],
            ['po_id' => 89,'pid' => random_int(1,25),'unit_price' => random_int(1,30)*1000,'quantity' => random_int(1,10)],
        );
        foreach ($items as $item) {
//            dd(var_dump($product));
            PODetail::create($item);
        }
        Model::reguard();
        //
    }
}
