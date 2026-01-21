<?php

namespace App\Jobs;

use App\Models\MatterMoyenne;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveConduiteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data, $matter, $cutting;
    public function __construct($data, $matter, $cutting)
    {
        $this->data = $data;
        $this->matter = $matter;
        $this->cutting = $cutting;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = ClassementStudent($this->data);
        foreach($data as $item){
            $exist = MatterMoyenne::where('inscriptif_id', $item['id'])->where('discipline_level_id', $this->matter)->where('cutting_school_year_id', $this->cutting)->first();
            $exist ?
            $exist->update([
                'rang' => $item['rang'],
                'moyenne' => $item['moyen']
            ]):
            $this->saveMoyenne($item['moyen'], $item['rang'], $item['id']);
        }
    }


    private function saveMoyenne($moyen, $rang, $item){
        MatterMoyenne::create([
            'rang' => $rang,
            'moyenne' => $moyen,
            'inscriptif_id' => $item,
            'discipline_level_id' => $this->matter,
            'cutting_school_year_id' => $this->cutting
        ]);
    }
}
