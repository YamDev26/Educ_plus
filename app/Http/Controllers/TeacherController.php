<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\UserUpdatedEvent;
use App\Events\UserRegisteredEvent;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Exports\TeachedExport;
use App\Imports\TeachedImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.teachers.index');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    public function dataTable(){
        $query = User::where('actif', '1')->where('role_id', '6')->orderBy('first_name')->orderBy('last_name');
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
        ->rawColumns(['counter', 'name', 'email', 'contact', 'action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $pieces = ['carte d\'identité', 'parmis de conduire', 'passport'];
            return view('pages.teachers.create',[
                'data' => null,
                'pieces' => $pieces
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
    public function store(Request $request)
    {
        $val = $request->validate([
            'matter' => 'required|string',
            'civilite' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'piece' => 'required|string',
            'num_piece' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'contact1' => 'required|string|unique:users,contact1',
            'contact2' => 'nullable|string|unique:users,contact2',
            'niveau' => 'required|string',
            'diplome' => 'required|string',
            'autorise' => 'required|string',
            'num_autorise' => 'nullable|string',
            'type' => 'required|string',
            'number' => 'required|integer',
            'num_autorise' => 'nullable|string',
        ]);
        event(new UserRegisteredEvent($val['first_name'], $val['last_name'], $val['civilite'], $val['piece'], $val['num_piece'],
        $val['contact1'], $request['contact2'], $val['email'], $val['niveau'], $val['diplome'], $val['autorise'], 
        $request['num_autorise'], $val['type'], $val['number'], 6, $val['matter']));
        return to_route('teacher.index')->with([
            'str' => 'success',
            'msg' => 'Enseignenant Enregistré avec success.'
        ]);
    }


    public function export(){
        try{
            $str = Str::upper(Str::random(2));
            $name = 'file_new_teacher_'.$str.'_1';
            return Excel::download(new TeachedExport(), $name.'.xlsx');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    public function import(Request $request){
        try{
            $request->validate([
                'files' => 'required|file|mimes:xlsx|max:2048'
            ]);
            $file = $request->file('files');
            Excel::import(new TeachedImport(), $file);
            return back()->with([
                'str' => 'success',
                'msg' => 'Impotation réussie.'
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
        try{
            $user = User::find($id);
            // dd($user);
            return view('pages.teachers.detail',[
                'user' => $user
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
    public function edit(string $id)
    {
        try{
            $user = User::find($id);
            $pieces = ['carte d\'identité', 'parmis de conduire', 'passport'];
            return view('pages.teachers.create',[
                'data' => $user,
                'pieces' => $pieces
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
        $val = $request->validate([
            'matter' => 'required|string',
            'civilite' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'piece' => 'required|string',
            'num_piece' => 'required|string',
            'email' => 'required|email',
            'contact1' => 'required|string',
            'contact2' => 'nullable|string',
            'niveau' => 'required|string',
            'diplome' => 'required|string',
            'autorise' => 'required|string',
            'num_autorise' => 'nullable|string',
            'type' => 'required|string',
            'number' => 'required|integer',
            'num_autorise' => 'nullable|string',
            'status' => 'required|string',
        ]);

        event(new UserUpdatedEvent($val['first_name'], $val['last_name'], $val['civilite'], $val['piece'], $val['num_piece'],
        $val['contact1'], $request['contact2'], $val['email'], $val['niveau'], $val['diplome'], $val['autorise'], 
        $request['num_autorise'], $val['type'], $val['number'], $val['matter'], $val['status'], $id));
        return to_route('teacher.index')->with([
            'str' => 'info',
            'msg' => 'Modification effectuée avec success.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
