<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etabs;
use App\Forms;
use App\Promos;
use App\Semestre;
use App\Annee;
use App\snote;
use Yajra\DataTables\DataTables;

class DelibController extends Controller
{
    public function index()
    {
        $etab = Etabs::where('active', 1)->get();
        return view('delib.index', compact('etab'));
    }
    public function show(Request $request)
    {
        $code_formation = $request->get('forma');
        $id_semestre = $request->get('semestre');
        $ann = Annee::where('code_formation', $code_formation)
                    ->where('validation_academique', 'non')
                    ->pluck('id_annee');
        $data = snote::with('ins')->with('statuts')->where('id_semestre', $id_semestre)
                        ->wherein('id_annee', $ann)
                        ->get();
        return Datatables::of($data)->addColumn('access', '<a href="#">test</a>')->make(true);
    }
    public function bystudent($id)
    {
        $mno = \App\Mnotes::with('status')->with('module')->where('id_inscription', $id)->get();
        $stu = \App\Inscription::find($id);
        // return view('delib.student', compact('mno', 'stu'));
        return $mno;
    }
    public function forma($id)
    {
        $data = Forms::where('code_etablissement', $id)
                    ->where('active', 1)
                    ->wherenotnull('code_departement')
                    ->get();
        return response()->json($data);
    }
    public function promos($id)
    {
        $data = Promos::where('code_formation', $id)
                    ->where('active', 1)
                    ->where('cloture_academique', 'non')
                    ->get();
        return response()->json($data);
    }
    public function semestre($id)
    {
        $data = Semestre::where('code_promotion', $id)
                    ->where('active', 1)
                    ->get();
        return response()->json($data);
    }
}
