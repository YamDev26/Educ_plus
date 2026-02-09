<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.users.index');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function dataTable(){
        $query = User::where('actif', '1')->where('role_id', '!=', '6')->where('role_id', '!=', '1')->orderBy('first_name')->orderBy('last_name');
        $counter = 0;
        return DataTables::of($query)
        ->addColumn('counter', function() use (&$counter) {
            return $counter < 9 ? '0'.++$counter : ++$counter;
        })
        ->addColumn('name', function ($data) {
            return ('<div class="ms-2 pt-1">
                <h6 class="mb-1 font-14">'.ucfirst($data->civilite).' '.strtoupper($data->first_name).' '.ucwords($data->last_name).'</h6>
            </div>');
        })
        ->addColumn('email', function ($data) {
            return ('<div class="ms-2 pt-1">
                <h6 class="mb-1 font-14">'.$data->email.'</h6>
            </div>');
        })
        ->addColumn('contact', function ($data) {
            return ('<div class="ms-2 pt-1">
                <h6 class="mb-1 font-14">'.$data->contact1.($data->contact2 ? ' / '.$data->contact2:null).'</h6>
            </div>');
        })
        ->addColumn('profil', function ($data) {
            return ('<div class="ms-2 pt-1">
                <h6 class="mb-1 font-14">'.ucwords($data->role->libelle).'</h6>
            </div>');
        })
        ->addColumn('action', function ($data) {
            $edit = route('teacher.edit',$data->id);
            $show = route('teacher.show',$data->id);
            return ('<div class="d-flex justify-content-center">
                <a href="'.$show.'" class="btn btn-outline-light py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px"><i class="bx bx-show-alt mx-0" style="font-size: 19px"></i></a>
                <a href="'.$edit.'" class="btn btn-outline-light py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px"><i class="bx bx-edit mx-0" style="font-size: 19px"></i></a>
            </div>');
        })
        ->filterColumn('name', function($query, $keyword) {
            $query->whereRaw("CONCAT(first_name, ' ', last_name, ' ', civilite) like ?", ["%$keyword%"]);
        })
        ->filterColumn('email', function($query, $keyword) {
            $query->whereRaw("CONCAT(email) like ?", ["%$keyword%"]);
        })
        ->filterColumn('contact', function($query, $keyword) {
            $query->whereRaw("CONCAT(contact1, ' ', contact2) like ?", ["%$keyword%"]);
        })
        ->rawColumns(['counter', 'name', 'email', 'contact', 'profil', 'action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $profil = Role::where('id', '!=', '1')->where('id', '!=', '6')->orderBy('libelle')->get();
            dd($profil);
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
}
