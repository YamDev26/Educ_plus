<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\Models\School;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $school = School::first();
            return view($school ? 'pages.schools.index':'pages.schools.create' ,[
                'school' => $school ?? []
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
    public function store(SchoolRequest $request)
    {
        try{
            $validat = $request->validated();

             /** @var UploadedFile $img */ 
            if($request['fichier']){
                $name = 'logo_school_v1.png'; // Debut du mail + année en cours
                $file = $validat['fichier']->storeAs('logo', $name, 'public');
            }
            School::create([
                'code' => $validat['codeSchool'],
                'name' => strtolower($validat['nomSchool']),
                'abrege' => strtolower($validat['nomAbrege']),
                'statut' => $validat['statut'],
                'college' => $request['college'] ? '1':'0',
                'lycee' => $request['lycee'] ? '1':'0',
                'dren' => strtolower($validat['drenSchool']),
                'ville' => strtolower($validat['villeSchool']),
                'postale' => $validat['boitePostale'] ?? null,
                'email' => $validat['emailSchool'],
                'numero' => $validat['numSchool'],
                'created' => $validat['create'],
                'opened' => $validat['ouverture'] ?? null,
                'paiement' => $validat['paiement'] == 'oui' ? '1':'0',
                'informatik' => $validat['informatik'] == 'oui' ? '1':'0',
                'autres' => $validat['autres'] == 'oui' ? '1':'0',
                'logo' => $file ?? null,
            ]);
            return to_route('school.index')->with([
                'str' => 'success',
                'msg' => 'Enregistrment effectué avec succes.'
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
    public function edit()
    {
        try{
            $school = School::first();
            return view('pages.schools.create',[
                'school' => $school
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
    public function update(SchoolRequest $request)
    {
        try{
            $validat = $request->validated();
            $school = School::first();

            /** @var UploadedFile $img */ 
            if($request['fichier']){
                if ($school->logo && Storage::exists('app/public/logo/'.$school->logo)) {
                    Storage::delete('app/public/logo/'.$school->logo);
                }
                $name = 'logo_school_v1.png';
                $file = $validat['fichier']->storeAs('logo', $name, 'public');
            }
            
            $school->update([
                'code' => $validat['codeSchool'],
                'name' => strtolower($validat['nomSchool']),
                'abrege' => strtolower($validat['nomAbrege']),
                'statut' => $validat['statut'],
                'college' => $request['college'] ? '1':'0',
                'lycee' => $request['lycee'] ? '1':'0',
                'dren' => strtolower($validat['drenSchool']),
                'ville' => strtolower($validat['villeSchool']),
                'postale' => $validat['boitePostale'] ?? null,
                'email' => $validat['emailSchool'],
                'numero' => $validat['numSchool'],
                'created' => $validat['create'],
                'opened' => $validat['ouverture'] ?? null,
                'paiement' => $validat['paiement'] == 'oui' ? '1':'0',
                'informatik' => $validat['informatik'] == 'oui' ? '1':'0',
                'autres' => $validat['autres'] == 'oui' ? '1':'0',
                'logo' => $file ?? $school['logo'],
            ]);
            return to_route('school.index')->with([
                'str' => 'info',
                'msg' => 'Modification effectuée'
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
