<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public static function userVendors()
    {
        $user = auth()->user()->id;
        return Vendor::where('user', $user)->get();
    }

    public static function vendorNames()
    {
        $user = auth()->user()->id;
        $vendorNames = Vendor::select('vendor')->where('user', $user)->get();
        $vendorNamesRefined = null;
        foreach ($vendorNames as &$vendorName) {
            $vendorNamesRefined[] = $vendorName->attributes['vendor'];
        }
        return $vendorNamesRefined;
    }
}
