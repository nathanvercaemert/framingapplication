<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    public static function nextReportNumber()
    {
        $user = auth()->user()->id;
        $maxReport = \DB::select(
            \DB::raw("
                SELECT MAX(reportNumber) reportNumber
                FROM report_models
                WHERE user = :user;
            "),
            array('user' => $user)
        );
        $maxReport = $maxReport[0]->reportNumber;
        return $maxReport + 1;
    }
}
