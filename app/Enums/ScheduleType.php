<?php 

namespace App\Enums;

enum ScheduleType: int
{
    case weekDays = 1;
    case everyday = 2;
}
