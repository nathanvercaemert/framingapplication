<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foamcore extends Model
{
    public static function userFoamcores()
    {
        $user = auth()->user()->id;
        return Foamcore::where('user', $user)->get();
    }

    public static function foamcoreTypes()
    {
        $user = auth()->user()->id;
        $foarmcoreTypes = Foamcore::select('foamcoreType')->where('user', $user)->get();
        $foarmcoreTypesRefined = null;
        foreach ($foarmcoreTypes as &$foamcoreType) {
            $foarmcoreTypesRefined[] = $foamcoreType->attributes['foamcoreType'];
        }
        return $foarmcoreTypesRefined;
    }
}
