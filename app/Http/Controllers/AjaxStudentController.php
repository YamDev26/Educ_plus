<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Classe;
use App\Models\Student;
use App\Models\ParentStd;
use App\Models\Nationality;
use Illuminate\Http\Request;

class AjaxStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function classe(Request $request)
    {
        try{
            if($request['lv2'] && $request['serie']){
                $class = Classe::where('level_id', $request['level'])->where('effectif', '>', 'inscrit')
                ->where('serie_id', $request['serie'])->where('lv2', $request['lv2'])->orWhere('lv2', 'mixte')->get();
            }
            elseif($request['serie']){
                $class = Classe::where('level_id', $request['level'])->where('effectif', '>', 'inscrit')
                ->where('serie_id', $request['serie'])->get();
            }
            elseif($request['lv2']){
                $class = Classe::where('level_id', $request['level'])->where('effectif', '>', 'inscrit')
                ->where('lv2', $request['lv2'])->orWhere('lv2', 'mixte')->get();
            }
            else{
                $class =  Classe::where('level_id', $request['level'])->where('effectif', '>', 'inscrit')->get();
            }

            return response()->json([
                'status' => count($class) ? 200:201,
                'data' => $class ?? []
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
    public function serie(Request $request)
    {
        try{
            $data = Serie::where(strtolower($request['code']), '1')->get();
            return response()->json([
                'status' => count($data) ? 200:201,
                'data' => $data ?? []
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
    public function matricule(Request $request)
    {
        try{
            $count = Student::where('matricule', $request['mtls'])->count();
            return response()->json([$count ? 200:201]);
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
    public function phon(Request $request)
    {
        try{
            $dts = ParentStd::where('phon1', $request['phon'])->orWhere('phon2', $request['phon'])->first();
            return response()->json([
                'status' => $dts ? 200:201,
                'data' => $dts ?? []
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
    public function natiolity(Request $request)
    {
        try{
            $dts = Nationality::where('libelle', 'LIKE', '%' . $request['val'])->first();
            return response()->json([
                'status' => $dts ? 200:201,
                'data' => $dts ?? []
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
