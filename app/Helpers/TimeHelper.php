<?php

namespace App\Helpers;

class TimeHelper {
    public static function checkOverlapForTwoTime($start_at_fix,$end_at_fix,$start_at_new,$end_at_new)
    {
        if (
            (($start_at_fix < $end_at_new) && ($start_at_fix > $start_at_new))
            || (($start_at_fix < $start_at_new) && ($start_at_new < $end_at_fix))
            || (($start_at_fix > $start_at_new) &&  ( $end_at_new>$start_at_fix ) && ($end_at_fix > $end_at_new))
            || (($start_at_fix < $start_at_new) &&  ( $end_at_new>$start_at_fix ) && ($end_at_fix > $end_at_new))
            || (($start_at_fix <= $start_at_new) &&  ( $end_at_fix<$start_at_fix ) && ($end_at_fix < $end_at_new))
        ) {
            // conflict happens if Red starts sometime between Orange start and end
            //               or if Red ends sometime between Orange start and end
            //               or if Red starts before Orange starts and ends after Orange ends
            return true;
        }
        else{
            return false;
        }
    }
}
