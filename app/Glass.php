<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glass extends Model
{
    public static function userGlasses()
    {
        $user = auth()->user()->id;
        return Glass::where('user', $user)->get();
    }

    public static function glassTypes()
    {
        $user = auth()->user()->id;
        $glassTypes = Glass::select('glassType')->where('user', $user)->get();
        $glassTypesRefined = null;
        foreach ($glassTypes as &$glassType) {
            $glassTypesRefined[] = $glassType->attributes['glassType'];
        }
        return $glassTypesRefined;
    }
}
