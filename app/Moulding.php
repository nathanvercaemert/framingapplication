<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moulding extends Model
{
    public static function userMouldings()
    {
        $user = auth()->user()->id;
        return Moulding::where('user', $user)->get();
    }

    public static function mouldingNumbers()
    {
        $user = auth()->user()->id;
        $mouldingNumbers = Moulding::select('mouldingNumber')->where('user', $user)->get();
        $mouldingNumbersRefined = null;
        foreach ($mouldingNumbers as &$mouldingNumber) {
            $mouldingNumbersRefined[] = $mouldingNumber->attributes['mouldingNumber'];
        }
        return $mouldingNumbersRefined;
    }
}
