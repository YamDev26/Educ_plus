<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use App\Events\CuttingEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            // utilisateur connecté ------------
            $user = Auth::user();

            // Déclenchement d'événement
            event(new CuttingEvent($this->year()));

            return view($user->role_id != 6 ? 'pages.dashboard_1':'pages.dashboard_2');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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


    /**
     * Remove the specified resource from storage.
     */
    private function year(){
        $actif = SchoolYear::where('actif', '1')->first();
        return $actif->id;
    }
}
