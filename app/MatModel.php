<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatModel extends Model
{
    public static function userMats()
    {
        $user = auth()->user()->id;
        return MatModel::where('user', $user)->get();
    }

    public static function matNumbers()
    {
        $user = auth()->user()->id;
        $matNumbers = MatModel::select('matNumber')->where('user', $user)->get();
        $matNumbersRefined = null;
        foreach ($matNumbers as &$matNumber) {
            $matNumbersRefined[] = $matNumber->attributes['matNumber'];
        }
        return $matNumbersRefined;
    }
}
