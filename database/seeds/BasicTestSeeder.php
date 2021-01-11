<?php

use Illuminate\Database\Seeder;

class BasicTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the users
        $userNumber = 1;
        $reportOrderNumber = 1;
        for ($i = 1; $i <= 10; $i++) {
            $nameString = 'test' . $userNumber . 'Name';
            $emailString = 'test' . $userNumber . 'Email@gmail.com';
            DB::table('users')->insert([
                'name' => $nameString,
                'email' => $emailString,
                'password' => Hash::make('testpassword'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // get the id for the user
            $userId = $results = DB::select( DB::raw("SELECT id FROM users WHERE name = '$nameString'") );
            $userId = $userId[0]->id;

            // make vendors/materials for the user
            $vendorNumber = 1;
            $materialNumber = 1;
            $materialPrice = 10;
            for ($j = 1; $j <= 3; $j++) {
                $vendorString = $nameString . 'Vendor' . $vendorNumber;
                $vendorNotesString = 'notes for ' . $vendorString;
                DB::table('vendors')->insert([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'vendor' => $vendorString,
                    'vendorNotes' => $vendorNotesString,
                    'user' => $userId,
                ]);

                for ($k = 1; $k <= 3; $k++) {

                    DB::table('mouldings')->insert([
                        'created_at' => now(),
                        'updated_at' => now(),
                        'mouldingNumber' => $materialNumber,
                        'mouldingVendor' => $vendorString,
                        'mouldingPrice' => $materialPrice,
                        'user' => $userId,
                    ]);

                    DB::table('mat_models')->insert([
                        'created_at' => now(),
                        'updated_at' => now(),
                        'matNumber' => $materialNumber,
                        'matVendor' => $vendorString,
                        'matPrice' => $materialPrice,
                        'user' => $userId,
                    ]);

                    $glassType = 'glass' . $materialNumber;
                    DB::table('glasses')->insert([
                        'created_at' => now(),
                        'updated_at' => now(),
                        'glassType' => $glassType,
                        'glassVendor' => $vendorString,
                        'glassPrice' => $materialPrice,
                        'user' => $userId,
                    ]);

                    $foamcoreType = 'foamcore' . $materialNumber;
                    DB::table('foamcores')->insert([
                        'created_at' => now(),
                        'updated_at' => now(),
                        'foamcoreType' => $foamcoreType,
                        'foamcoreVendor' => $vendorString,
                        'foamcorePrice' => $materialPrice,
                        'user' => $userId,
                    ]);

                    $materialNumber++;
                    $materialPrice++;
                }

                $vendorNumber++;
            }

            // create orders
            $orderNumber = 1;
            for ($j = 1; $j <= 4; $j++) {
                $firstName = 'firstName' . $orderNumber;
                $lastName = 'lastName' . $orderNumber;
                $email = 'email' . $orderNumber . '@gmail.com';
                $orderGlassType = 'glass' . $orderNumber;
                $orderFoamcoreType = 'foamcore' . $orderNumber;
                $orderNotes = 'notes for order ' . $orderNumber;
                DB::table('orders')->insert([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'user' => $userId,
                    'orderNumber' => $orderNumber,
                    'isReported' => 1,
                    'reportNumber' => intdiv($orderNumber - 1, 2) + 1,
                    'customerFirst' => $firstName,
                    'customerLast' => $lastName,
                    'customerEmail' => $email,
                    'customerPhoneArea' => 123,
                    'customerPhone3' => 456,
                    'customerPhone4' => 7890,
                    'orderMouldingNumber' => $orderNumber,
                    'orderGlassType' => $orderGlassType,
                    'orderFoamcoreType' => $orderFoamcoreType,
                    'orderType' => 'Frame',
                    'orderWidth' => 36,
                    'orderHeight' => 24,
                    'orderFirstMatNumber' => $orderNumber,
                    'orderSecondMatNumber' => $orderNumber + 1,
                    'orderThirdMatNumber' => -1,
                    'orderNotes' => $orderNotes,
                    'isCompleted' => 0,
                    'completed_at' => null,
                    'orderPrice' => 100.00,
                ]);
                $orderNumber++;
            }
            for ($j = 1; $j <= 4; $j++) {
                $firstName = 'firstName' . $orderNumber;
                $lastName = 'lastName' . $orderNumber;
                $email = 'email' . $orderNumber . '@gmail.com';
                $orderFoamcoreType = 'foamcore' . $orderNumber;
                $orderNotes = 'notes for order ' . $orderNumber;
                DB::table('orders')->insert([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'user' => $userId,
                    'orderNumber' => $orderNumber,
                    'isReported' => 1,
                    'reportNumber' => intdiv($orderNumber - 1, 2) + 1,
                    'customerFirst' => $firstName,
                    'customerLast' => $lastName,
                    'customerEmail' => $email,
                    'customerPhoneArea' => 123,
                    'customerPhone3' => 456,
                    'customerPhone4' => 7890,
                    'orderMouldingNumber' => -1,
                    'orderGlassType' => -1,
                    'orderFoamcoreType' => $orderFoamcoreType,
                    'orderType' => 'Mount',
                    'orderWidth' => 36,
                    'orderHeight' => 24,
                    'orderFirstMatNumber' => -1,
                    'orderSecondMatNumber' => -1,
                    'orderThirdMatNumber' => -1,
                    'orderNotes' => $orderNotes,
                    'isCompleted' => 0,
                    'completed_at' => null,
                    'orderPrice' => 100.00,
                ]);
                $orderNumber++;
            }

            // create reports
            $reportNumber = 1;
            for ($j = 1; $j <= 3; $j++) {
                $reportOrderList = $reportOrderNumber++ . ',' . $reportOrderNumber++;
                $reportNotes = 'notes for report ' . $reportNumber;
                DB::table('report_models')->insert([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'processed_at' => null,
                    'isProcessed' => 0,
                    'beginDate' => null,
                    'endDate' => null,
                    'reportNumber' => $reportNumber,
                    'reportOrderList' => $reportOrderList,
                    'reportIsDateRange' => 0,
                    'reportIsSpecificOrders' => 1,
                    'reportNotes' => $reportNotes,
                    'user' => $userId,
                ]);
                $reportNumber++;
            }
            $reportOrderList = $reportOrderNumber++ . ',' . $reportOrderNumber++;
            $reportNotes = 'notes for report ' . $reportNumber;
            DB::table('report_models')->insert([
                'created_at' => now(),
                'updated_at' => now(),
                'processed_at' => null,
                'isProcessed' => 0,
                'beginDate' => now()->subWeek()->setTime(0, 0, 0),
                'endDate' => now()->addDays(1)->setTime(0, 0, 0),
                'reportNumber' => $reportNumber,
                'reportOrderList' => $reportOrderList,
                'reportIsDateRange' => 1,
                'reportIsSpecificOrders' => 0,
                'reportNotes' => $reportNotes,
                'user' => $userId,
            ]);
            $reportNumber++;

            $userNumber++;
        }
        DB::table('orders')->insert([
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDays(3),
            'user' => 10,
            'orderNumber' => 9,
            'isReported' => 0,
            'reportNumber' => -1,
            'customerFirst' => 'test10First',
            'customerLast' => 'test10Last',
            'customerEmail' => 'test10Email@gmail.com',
            'customerPhoneArea' => 123,
            'customerPhone3' => 456,
            'customerPhone4' => 7890,
            'orderMouldingNumber' => -1,
            'orderGlassType' => -1,
            'orderFoamcoreType' => 'foamcore7',
            'orderType' => 'Mount',
            'orderWidth' => 36,
            'orderHeight' => 24,
            'orderFirstMatNumber' => -1,
            'orderSecondMatNumber' => -1,
            'orderThirdMatNumber' => -1,
            'orderNotes' => 'notes for order 9',
            'isCompleted' => 0,
            'completed_at' => null,
            'orderPrice' => 100.00,
        ]);
        DB::table('orders')->insert([
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDays(3),
            'user' => 10,
            'orderNumber' => 10,
            'isReported' => 0,
            'reportNumber' => -1,
            'customerFirst' => 'test10First',
            'customerLast' => 'test10Last',
            'customerEmail' => 'test10Email@gmail.com',
            'customerPhoneArea' => 123,
            'customerPhone3' => 456,
            'customerPhone4' => 7890,
            'orderMouldingNumber' => -1,
            'orderGlassType' => -1,
            'orderFoamcoreType' => 'foamcore7',
            'orderType' => 'Mount',
            'orderWidth' => 36,
            'orderHeight' => 24,
            'orderFirstMatNumber' => -1,
            'orderSecondMatNumber' => -1,
            'orderThirdMatNumber' => -1,
            'orderNotes' => 'notes for order 10',
            'isCompleted' => 0,
            'completed_at' => null,
            'orderPrice' => 100.00,
        ]);
    }
}
