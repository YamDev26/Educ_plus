<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Classe;
use App\Models\DisciplineLevel;
use App\Models\CuttingSchoolYear;
use App\Events\EditMoyenneEvent;
use App\Jobs\CalculMoyenneClasseMatter;
use App\Services\MoyenneService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;

class MoyenneController extends Controller
{
    protected $service;
    public function __construct(MoyenneService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.moyennes.index');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    public function dataTable() {
        $actif = $this->service->yearActif();
        $query = Classe::where('school_year_id', $actif)->where('status', '1')->orderBy('level_id');
        $counter = 0;
        return DataTables::of($query)
        ->addColumn('counter', function() use (&$counter) {
            return $counter < 9 ? '0'.++$counter : ++$counter;
        })
        ->addColumn('inscrit', function ($row) {
            return $row->inscrit < 9 ? '0'.$row->inscrit : $row->inscrit;
        })
        ->addColumn('action', function ($data) {
            return ('<div class="py-0 d-flex justify-content-center">
                <button data-id="'.$data->id.'" data-lib="'.$data->libelle.'" class="btn btn-outline-light py-0 px-1" style="border: none; border-radius: 3px">
                <i class="fadeIn animated bx bx-slider m-0" style="font-size: 17px"></i>
                </button>
            </div>');
        })
        ->rawColumns(['counter', 'inscrit', 'action'])
        ->make(true);
    }

    public function search() {
        try{
            $actif = $this->service->yearActif();
            $cutting = CuttingSchoolYear::where('school_year_id', $actif)->get();
            return Response()->json([
                'status' => $cutting ? 200:201,
                'data' => $cutting ? $this->service->getCutting($cutting):null
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    public function geeratePdf($str){
        try{
            list($id1, $id2) = explode('_', $str, 2);
            $class = Classe::find($id1);
            $cutting = CuttingSchoolYear::find($id2);
            $matters = $this->service->getMatters($class);
            $datas = $this->service->getMoyenneStudent($class, $id2);
            $name = 'liste_moyenne_'.$cutting->cutting->libelle.'_'.$class->libelle;
            $pdf = PDF::loadView('pages.moyennes.pdf.list_moyenne_classe',[
                'classe' => $class,
                'cutting' => $cutting,
                'school' => School::first(),
                'matters' => $matters,
                'data' => $datas,
                'enseignant' => $this->service->enseignant($id1),
            ])->setPaper('A4', 'landscape');// ou 'A4', 'A3', etc.
            return $pdf->stream($name.'.pdf');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $class = Classe::find($request['id1']);
            $data = $this->service->getMatterApproved($class, $request['id2']);
            return Response()->json([
                'status' => count($data) ? 200:201,
                'data' => count($data) ? $data:null
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function return($str)
    {
        try{
            list($id1, $id2) = explode('_', $str, 2);
            $class = Classe::find($id1);
            $cutting = CuttingSchoolYear::find($id2);
            $matters = $this->service->getMatters($class);
            $datas = $this->service->getMoyenneStudent($class, $id2);
            return view('pages.moyennes.detail',[
                'classe' => $class,
                'cutting' => $cutting,
                'matters' => $matters,
                'data' => $datas
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try{
            $val = $request->validate([
                'class' => 'required|string',
                'cutting' => 'required|string'
            ]);
            $class = Classe::find($val['class']);
            $cutting = CuttingSchoolYear::find($val['cutting']);
            $matters = $this->service->getMatters($class);
            $datas = $this->service->getMoyenneStudent($class, $val['cutting']);
            return view('pages.moyennes.detail',[
                'classe' => $class,
                'cutting' => $cutting,
                'matters' => $matters,
                'data' => $datas
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try{
            $val = $request->validate([
                'class' => 'required|string',
                'matter' => 'required|string',
                'cutting' => 'required|string'
            ]);
            $class = Classe::find($val['class']);
            $matter = DisciplineLevel::find($val['matter']);
            $cutting = CuttingSchoolYear::find($val['cutting']);
            $data = $this->service->getMoyenneMatterStudent($class, $val['cutting'], $val['matter']);
            return view('pages.moyennes.edit',[
                'data' => $data,
                'classe' => $class,
                'matter' => $matter,
                'cutting' => $cutting
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $val = $request->validate([
                'str' => 'required|string',
                'student' => 'required|array',
                'student.*' => 'required|string',
                'moyen' => 'required|array',
                'moyen.*' => 'nullable|string',
            ]);

            list($id1, $id2, $id3) = explode('_', $val['str'], 3);
            event(new EditMoyenneEvent($val['student'], $val['moyen'], $id3, $id2)); // Déclenchement d'événement
            CalculMoyenneClasseMatter::dispatch($id1, $id3, $id2); // Déclenchement de job pour le calcul de moyenne
            $class = Classe::find($id1);
            $matter = DisciplineLevel::find($id3);
            $cutting = CuttingSchoolYear::find($id2);
            $data = $this->service->getMoyenneMatterStudent($class, $id2, $id3);
            return view('pages.moyennes.edit',[
                'data' => $data,
                'classe' => $class,
                'matter' => $matter,
                'cutting' => $cutting
            ])->with([
                'str' => 'info',
                'msg' => 'Modification prise en compte avec succes !'
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
