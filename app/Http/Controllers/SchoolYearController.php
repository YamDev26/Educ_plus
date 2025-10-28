<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $datas = SchoolYear::orderBy('created_at')->get();
            // dd($datas);
            return view('pages.years.index',[
                'datas' => $datas
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
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        try{
            $search = request('search'); // ou une variable $search
            $datas = SchoolYear::where('libelle', 'like', "%{$search}%")
            ->orWhere('current', 'like', "%{$search}%")
            ->orWhere('cutting', 'like', "%{$search}%")
            ->orderBy('created_at')
            ->paginate(10);
            return response()->json(['status' => count($datas) ? 200:201, 'data' => $datas]);
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
    public function store(Request $request)
    {
        try{
            $table = explode('/', $request['year']);
            if(count($table) == 1){
               $table = explode('-', $request['year']); 
            }
            $request['year'] = $table[0].'-'.$table[1];
            $request['current'] = (string)Carbon::now()->year;
            $val = $request->validate([
                'year' => 'required|string|unique:school_years,libelle',
                'current' => 'required|string|unique:school_years,current',
                'cutting' => 'required|string',
                'actif' => 'required|string'
            ]);
            if($val['actif'] == 'oui'){
                SchoolYear::where('actif', '1')->update(['actif' => '0']);
            }
            
            // Save Data
            SchoolYear::create([
                'libelle' => $val['year'],
                'current' => $val['current'],
                'cutting' => $val['cutting'],
                'actif' => $val['actif'] == 'non' ? '0':'1'
            ]);
            return back()->with([
                'str' => 'success',
                'msg' => 'Enregistrement effectué.'
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
    public function edit(Request $request,)
    {
        try{
            $id = request('id');
            $data = SchoolYear::find($id);
            return response()->json(['status' => $data ? 200:201, 'data' => $data]);
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
            $table = explode('/', $request['year']);
            if(count($table) == 1){
               $table = explode('-', $request['year']); 
            }
            $request['year'] = $table[0].'-'.$table[1];
            $val = $request->validate([
                'id' => 'required|integer',
                'year' => 'required|string',
                'cutting' => 'required|string',
            ]);
            if($request['statut']){
                SchoolYear::where('actif', '1')->update(['actif' => '0']);
            }
            SchoolYear::where('id', $val['id'])->update([
                'libelle' => $val['year'],
                'cutting' => $val['cutting'],
                'actif' => $request['statut'] ? '1':'0'
            ]);
            return back()->with([
                'str' => 'info',
                'msg' => 'Mofication effectuée.'
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
    public function destroy(Request $request)
    {
        try{
            $val = $request->validate([
                'id' => 'required|integer',
            ]);
            $data = SchoolYear::find($val['id']);
            if(!$data['actif']){
              $data->delete();
                $resut = ['info', 'Suppression effectuée.'];
            }
            else{
                $resut = ['warning', 'Année Scolaire activé !'];
            }
            return back()->with([
                'str' => $resut[0],
                'msg' => $resut[1]
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }
}
