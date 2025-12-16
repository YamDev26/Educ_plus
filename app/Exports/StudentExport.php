<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView
{
    public function View(): View
    {
        
        return view('pages.students.download.index');
    }
}
