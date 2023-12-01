<?php

namespace App\Helper;

use App\Enums\ScheduleType;
use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class VerifyTaskOfDay
{
    public static function isBusinessDay(): bool
    {
        $currentDay = Carbon::now();

        if (!$currentDay->isWeekday()) {
            return false;
        }

        return true;
    }

    // public function isBusinessDay(): bool
    // {
    //     $currentDay = Carbon::now();

    //     \dd($currentDay);
    // }   
}
