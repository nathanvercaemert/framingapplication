<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;

class DatabaseSeederMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $users = array(
            array(
                'name' => 'Test 1',
                'email' => 'test1@gmail.com',
                'password' => Hash::make('testpassword'),
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ),
        );

        $vendors = array(
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'vendor' => 'Mike\'s Mats and Mouldings',
                'vendorNotes' => '(336) 854-7661
Contact: Michael Gomez',
                'user' => '1',
            ),
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'vendor' => 'Glass Galore',
                'vendorNotes' => '(919) 675-5079
Contact: Charlie',
                'user' => '1',
            ),
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'vendor' => 'Mats and More',
                'vendorNotes' => '(336) 557-5412
Contact: Jillian Moore
closed Fridays',
                'user' => '1',
            ),
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'vendor' => 'The Foamcore Store',
                'vendorNotes' => '(704) 249-4401
Customer #: 64557895
Contact: Fred Williams',
                'user' => '1',
            ),
        );

        $mouldings = array(
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'mouldingNumber' => '1',
                'mouldingVendor' => 'Mike\'s Mats and Mouldings',
                'mouldingPrice' => '10.00',
                'user' => '1'
            ),
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'mouldingNumber' => '2',
                'mouldingVendor' => 'Mike\'s Mats and Mouldings',
                'mouldingPrice' => '20.00',
                'user' => '1'
            ),
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'mouldingNumber' => '3',
                'mouldingVendor' => 'Mike\'s Mats and Mouldings',
                'mouldingPrice' => '30.00',
                'user' => '1'
            ),
        );

        $mat_models = array(
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'matNumber' => '1',
                'matVendor' => 'Mike\'s Mats and Mouldings',
                'matPrice' => '10.00',
                'user' => '1'
            ),
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'matNumber' => '2',
                'matVendor' => 'Mats and More',
                'matPrice' => '20.00',
                'user' => '1'
            ),
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'matNumber' => '3',
                'matVendor' => 'Mats and More',
                'matPrice' => '30.00',
                'user' => '1'
            ),
        );

        $glasses = array(
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'glassType' => 'Standard',
                'glassVendor' => 'Glass Galore',
                'glassPrice' => '10.00',
                'user' => '1'
            ),
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'glassType' => 'Conservation',
                'glassVendor' => 'Glass Galore',
                'glassPrice' => '20.00',
                'user' => '1'
            ),
        );

        $foamcores = array(
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'foamcoreType' => 'Standard',
                'foamcoreVendor' => 'The Foamcore Store',
                'foamcorePrice' => '10.00',
                'user' => '1'
            ),
            array(
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
                'foamcoreType' => 'Thick',
                'foamcoreVendor' => 'The Foamcore Store',
                'foamcorePrice' => '20.00',
                'user' => '1'
            ),
        );

        $orders = array(
            array(
                'created_at' => Carbon::now()->subDays(11),
                'updated_at' => Carbon::now()->subDays(11),
                'completed_at' => Carbon::now()->subDays(1),
                'isCompleted' => '1',
                'user' => '1',
                'orderNumber' => '1',
                'isReported' => '1',
                'reportNumber' => '1',
                'customerFirst' => 'Nathan',
                'customerLast' => 'Vercaemert',
                'customerEmail' => 'nathan.vercaemert@gmail.com',
                'customerPhoneArea' => '336',
                'customerPhone3' => '404',
                'customerPhone4' => '7705',
                'orderMouldingNumber' => '1',
                'orderGlassType' => 'Conservation',
                'orderFoamcoreType' => 'Standard',
                'orderType' => 'Frame',
                'orderWidth' => '24',
                'orderHeight' => '24',
                'orderFirstMatNumber' => '1',
                'orderSecondMatNumber' => '-1',
                'orderThirdMatNumber' => '-1',
                'orderPrice' => '240',
                'orderNotes' => '1" mat'
            ),
            array(
                'created_at' => Carbon::now()->subDays(9),
                'updated_at' => Carbon::now()->subDays(9),
                'completed_at' => null,
                'isCompleted' => '0',
                'user' => '1',
                'orderNumber' => '2',
                'isReported' => '1',
                'reportNumber' => '1',
                'customerFirst' => 'John',
                'customerLast' => 'Shin',
                'customerEmail' => 'jshin94@gmail.com',
                'customerPhoneArea' => '336',
                'customerPhone3' => '576',
                'customerPhone4' => '4457',
                'orderMouldingNumber' => '2',
                'orderGlassType' => 'Standard',
                'orderFoamcoreType' => 'Standard',
                'orderType' => 'Frame',
                'orderWidth' => '36',
                'orderHeight' => '24',
                'orderFirstMatNumber' => '2',
                'orderSecondMatNumber' => '1',
                'orderThirdMatNumber' => '-1',
                'orderPrice' => '500',
                'orderNotes' => '2" outer mat, 1/4" inner mat'
            ),
            array(
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
                'completed_at' => null,
                'isCompleted' => '0',
                'user' => '1',
                'orderNumber' => '3',
                'isReported' => '1',
                'reportNumber' => '1',
                'customerFirst' => 'Danny',
                'customerLast' => 'Hasset',
                'customerEmail' => 'dhasset95@gmail.com',
                'customerPhoneArea' => '336',
                'customerPhone3' => '845',
                'customerPhone4' => '2202',
                'orderMouldingNumber' => '-1',
                'orderGlassType' => '-1',
                'orderFoamcoreType' => 'Thick',
                'orderType' => 'Mount',
                'orderWidth' => '36',
                'orderHeight' => '24',
                'orderFirstMatNumber' => '-1',
                'orderSecondMatNumber' => '-1',
                'orderThirdMatNumber' => '-1',
                'orderPrice' => '120',
                'orderNotes' => 'make sure to include poster signature'
            ),
            array(
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
                'completed_at' => null,
                'isCompleted' => '0',
                'user' => '1',
                'orderNumber' => '4',
                'isReported' => '0',
                'reportNumber' => '-1',
                'customerFirst' => 'Josh',
                'customerLast' => 'Stainback',
                'customerEmail' => 'joshua.stainback.92@gmail.com',
                'customerPhoneArea' => '336',
                'customerPhone3' => '486',
                'customerPhone4' => '8865',
                'orderMouldingNumber' => '3',
                'orderGlassType' => 'Conservation',
                'orderFoamcoreType' => 'Standard',
                'orderType' => 'Frame',
                'orderWidth' => '12',
                'orderHeight' => '18',
                'orderFirstMatNumber' => '2',
                'orderSecondMatNumber' => '3',
                'orderThirdMatNumber' => '1',
                'orderPrice' => '270',
                'orderNotes' => 'work phone: (336) 576-2354'
            ),
            array(
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
                'completed_at' => null,
                'isCompleted' => '0',
                'user' => '1',
                'orderNumber' => '5',
                'isReported' => '0',
                'reportNumber' => '-1',
                'customerFirst' => 'Matthew',
                'customerLast' => 'York',
                'customerEmail' => 'footballer94@gmail.com',
                'customerPhoneArea' => '336',
                'customerPhone3' => '476',
                'customerPhone4' => '8799',
                'orderMouldingNumber' => '2',
                'orderGlassType' => 'Standard',
                'orderFoamcoreType' => 'Standard',
                'orderType' => 'Frame',
                'orderWidth' => '12',
                'orderHeight' => '12',
                'orderFirstMatNumber' => '2',
                'orderSecondMatNumber' => '-1',
                'orderThirdMatNumber' => '-1',
                'orderPrice' => '120',
                'orderNotes' => '1" mat'
            ),
        );

        $report_models = array(
            array(
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
                'processed_at' => Carbon::now()->subDays(3),
                'isProcessed' => '1',
                'beginDate' => Carbon::now()->subDays(10)->startOfDay(),
                'endDate' => Carbon::now()->subDays(2)->startOfDay(),
                'reportNumber' => '1',
                'reportOrderList' => '1,2,3',
                'reportIsDateRange' => '1',
                'reportIsSpecificOrders' => '0',
                'reportNotes' => 'Weekly order placed ' . Carbon::now()->subDays(3)->format('Y-m-d'),
                'user' => '1',
            ),
        );

        DB::table('users')->insert($users);
        DB::table('vendors')->insert($vendors);
        DB::table('mouldings')->insert($mouldings);
        DB::table('mat_models')->insert($mat_models);
        DB::table('glasses')->insert($glasses);
        DB::table('foamcores')->insert($foamcores);
        DB::table('orders')->insert($orders);
        DB::table('report_models')->insert($report_models);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
