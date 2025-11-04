<?php

namespace App\Listeners;

use App\Models\CuttingSchoolYear;
use App\Events\CuttingEvent;
use Carbon\Carbon;

class CuttingListener
{

    /**
     * Handle the event.
     */
    public function handle(CuttingEvent $event): void
    {
        $dts = $this->getActifCutting($event->year);
        if($dts){
            $date = Carbon::now()->format('Y-m-d');
            foreach($dts as $item){
                CuttingSchoolYear::where('id', $item['id'])->update([
                    'status' => compareToDate($date, $item['start'], $item['end'])
                ]);
            }
        }
    }


    private function getActifCutting($year){
        $dts = CuttingSchoolYear::where('school_year_id', $year)->where('status', '!=', '2')->get();
        return sizeof($dts) ? $dts:null;
    }
}
