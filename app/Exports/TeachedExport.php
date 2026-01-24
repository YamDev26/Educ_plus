<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TeachedExport implements FromView
{
    public function View(): View
    {
        return view('pages.teachers.download.index');
    }
}
