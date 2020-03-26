<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $module = \App\module::where('semestre', '144')->get();
        return view('m.index', compact('module'));

    }
    public function store(Request $req)
    {
        $mat = $req->input('matiere');
        foreach ($mat as $key => $value) {
            $matiere = new \App\matiere([
                'module' => $req->input('module'),
                'matiere' => $value,
            ]);
            $matiere->save();
        }

        return response()->json(['success'=>'Saved succesfully.']);

    }
    public function create()
    {
        return view('m.create');
    }
    public function ma($id)
    {
        $mat = \App\matiere::where('module', $id)->get();

        return response()->json($mat);
    }
    public function modules()
    {
        $query = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/module/238");
        $res = json_decode($query, true);
        $modules = [];
        $matiere = [];
        $modu = collect($res)->where('semestre_id', '144')->where('active', '1')->pluck('id');
        $query2 = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/element/200");
        $res2 = json_decode($query2, true);
        $m = collect($res2)->wherein('module_id', $modu)->where('active', 1);

        foreach ($m as $value) {
            $matiere = new \App\matiere;
            $matiere->module = $value['module_id'];
            $matiere->matiere = $value['designation'];
            $matiere->save();
        }

        return $m;

    }
    public function updatemid()
    {
       $matiere = \App\matiere::where('id', '>', '18')->get();
       foreach ($matiere as $key => $value) {
           $id = $value->module_id - 1;
           $req = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/module/".$id);
           $res = json_decode($req, True);
           $colle = $res[0];
           $modu = \App\module::where('module', 'LIKE', '%'.$colle['designation'].'%')->first();
           $upd = \App\matiere::where('id', $value->id)->update([
               'module' => $modu['id'],
           ]);
            echo $modu['id']."<br/>";
       }
    }
    public function ass()
    {
        $full = \DB::connection('mysql2')->table('xseance_absences')->where('Nom', 'MASAOUDI')->where('Prénom', 'Youness')->get();
        foreach ($full as $key => $value) {
            $ass = new \App\Absence;
            $ass->ID_Seance = $value->ID_Séance;
            $ass->Date_Pointage = $value->Date_Pointage;
            $ass->Heure_Pointage = $value->Heure_Pointage;
            $ass->Categorie = $value->Categorie;
            $ass->Justifier = $value->Justifier;
            $ass->Comptabilise = $value->Comptabilisé;
            $ass->save();
        }
        $last = \App\Absence::orderBy('id', 'DESC')->first();
        return response()->json($last, 200);
    }
}
