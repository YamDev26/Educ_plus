<?php

namespace App\Http\Controllers;

use App\Models\SlotTime;
use Illuminate\Http\Request;

class SlotTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $morning = SlotTime::where('statut', '1')->orderBy('order')->get();
            $after = SlotTime::where('statut', '2')->orderBy('order')->get();
            return view('pages.slot.index',[
                'morning' => $morning,
                'after' => $after
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
             return view('pages.slot.create',[
                'dts' => []
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
        try{
            $val = $request->validate([
                'martin1' => 'required|array',
                'martin2' => 'required|array',
                'after1' => 'required|array',
                'after2' => 'required|array',
                'martin1.*' => 'nullable|date_format:H:i',
                'martin2.*' => 'nullable|date_format:H:i',
                'after1.*' => 'nullable|date_format:H:i',
                'after2.*' => 'nullable|date_format:H:i',

            ]);
            if((count($val["martin1"]) == count($val['martin2'])) && (count($val['after1']) == count($val['after2']))){
                $this->slotTimeMorning($val["martin1"], $val['martin2']);
                $this->slotTimeAfter($val["after1"], $val['after2']);
                return to_route('slot.index')->with([
                    'str' => 'success',
                    'msg' => 'Enregistrement effectué.'
                ]);
            }
            else{
                return back()->with([
                    'str' => 'danger',
                    'msg' => 'Une erreur est survenue !'
                ]);
            }
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
    public function search(Request $request)
    {
        try{
            $search = request('search'); // ou une variable $search
            $datas = SlotTime::where('libelle', 'like', "%{$search}%")
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
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $vals = $request->validate([
                'id' => 'required|integer',
                'debut' => 'required|date_format:H:i',
                'fin' => 'required|date_format:H:i',
            ]);

            $dts = SlotTime::find($vals['id']);
            if($dts){
                $dts->update([
                    'debut' => $vals['debut'],
                    'fin' => $vals['fin']
                ]);
                return back()->with([
                    'str' => 'info',
                    'msg' => 'Modification prise en compte'
                ]);
            }
            else{
                return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
            }
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



    private function slotTimeMorning($slot1, $slot2){
        $i = 0;
        while($i < count($slot1)){
            if($slot1[$i] && $slot2[$i]){
                SlotTime::create([
                    'debut' => $slot1[$i],
                    'fin' => $slot2[$i],
                    'order' => $i+1,
                    'statut' => '1',
                ]);
            }
            $i++;
        }
    }


    private function slotTimeAfter($slot1, $slot2){
        $i = 0;
        while($i < count($slot1)){
            if(($slot1[$i] && $slot2[$i])){
                SlotTime::create([
                    'debut' => $slot1[$i],
                    'fin' => $slot2[$i],
                    'order' => $i+1,
                    'statut' => '2',
                ]);
            }
            $i++;
        }
    }
}
