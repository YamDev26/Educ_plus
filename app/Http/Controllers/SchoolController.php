<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $school = School::first();
            return view('pages.schools.index',[
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            return view('pages.schools.create');
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
            if($validat['file']){
                $name = 'logo_1_'.date('Y').'.png'; // Debut du mail + année en cours
                $file = $img['file']->storeAs('logo', $name, 'public');
            }
            School::create([
                'code' => $validat['codeSchool'],
                'name' => strtolower($validat['nomSchool']),
                'abrege' => strtolower($validat['nomAbrege']),
                'statut' => $validat['statut'],
                'college' => $validat['college'] ? '1':'0',
                'lycee' => $validat['lycee'] ? '1':'0',
                'dren' => strtolower($validat['drenSchool']),
                'ville' => strtolower($validat['villeSchool']),
                'postale' => $validat['boitePostale'] ?? null,
                'email' => $validat['emailSchool'],
                'numero' => $validat['numSchool'],
                'create' => $validat['create'],
                'ouverture' => $validat['ouverture'] ?? null,
                'classe' => $validat['nbreClasse'],
                'bibliotheque' => $validat['bibliotheque'] == 'oui' ? '1':'0',
                'phis_chim' => $validat['physChim'] == 'oui' ? '1':'0',
                'svt' => $validat['svt'] == 'oui' ? '1':'0',
                'informatique' => $validat['info'] == 'oui' ? '1':'0',
                'cantine' => $validat['cantine'] == 'oui' ? '1':'0',
                'bus' => $validat['bus'] == 'oui' ? '1':'0',
                'caisse' => $validat['paiement'] == 'oui' ? '1':'0',
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
