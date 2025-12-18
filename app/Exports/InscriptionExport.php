<?php

namespace App\Exports;

use App\Models\Classe;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InscriptionExport implements FromView
{
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }


    public function View(): View
    {
        return view('pages.inscription.download.index',[
            'classe' => $this->classe(),
        ]);
    }


    private function classe(){
        $dts = Classe::find($this->id);
        return $dts;
    }
}
