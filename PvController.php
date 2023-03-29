<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\ViewModel;
use App\Models\Ville;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class PvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $My_view=ViewModel::all();
            $villes=DB::table('villes')->select('nom_ville')->distinct()->get();
            $complexes=DB::table('complexes')->select('nom_cmp')->distinct()->get();
            $Etb=DB::table('etablissements')->select('nom_Etb')->distinct()->get();
            if($request->nom_ville){
                $data=ViewModel::where('nom_ville',$request->nom_ville);
                $complexes=DB::table('complexes')->select('nom_cmp')->where('code_ville',$request->nom_ville);
                return Datatables::of($data)->make(true);
            }
            if($request->nom_cmp){
                $data=ViewModel::where('nom_cmp',$request->nom_cmp);
                return Datatables::of($data)->make(true);
            }
            if($request->nom_Etb){
                $data=ViewModel::where('nom_Etb',$request->nom_Etb);
                return DataTables::of($data)->make(true);
            };
            if($request->date){
                $data=ViewModel::where('date',$request->date);
                return DataTables::of($data)->make(true);
            };
            if($request->date && $request->nom_ville){
                $data=ViewModel::where('date',$request->date)->where('nom_ville',$request->nom_ville);
                return DataTables::of($data)->make(true);
            }
            return view('MyPvs.index',compact('My_view','villes','complexes','Etb'));
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

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
    public function filter(Request $request){
        
        $My_view=ViewModel::get()->where('code_ville',$request->code_ville)->get();
        return response()->json($My_view);
    }
}




