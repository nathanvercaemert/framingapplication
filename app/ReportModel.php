<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    public static function userReports()
    {
        $user = auth()->user()->id;
        $reports = ReportModel::where('user', $user)->get();
        return $reports;
    }
    public static function nextReportNumber()
    {
        $user = auth()->user()->id;
        $maxReport = \DB::select(
            \DB::raw("
                SELECT MAX(CAST(reportNumber AS SIGNED)) reportNumber
                FROM report_models
                WHERE user = :user;
            "),
            array('user' => $user)
        );
        $maxReport = $maxReport[0]->reportNumber;
        return $maxReport + 1;
    }
}
