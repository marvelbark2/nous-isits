<?php

namespace App\Http\Controllers;

use DB;
use App\Logs;
use App\enote;
use App\gnote;
use App\mnote;
use App\Notes;
use App\snote;
use App\Semestre;
use Carbon\Carbon;
use App\Charts\Metro;
use GuzzleHttp\Client;
use App\Exports\NotesExport;
use App\Imports\NotesImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\DataTables\NotesDataTable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use App\Annee;



class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('SP');
    }
    public function index()
    {
        $notes = Notes::where('tid', '7887')->get();
        $mdl = \App\module::with('note')->where('semestre', '0')->get();
        $abs = \App\Absence::select(DB::raw('SUM(Comptabilise)* -1 as `data`'), DB::raw("DATE_FORMAT(date, '%Y') year"),DB::raw('MONTH(date) months'),  DB::raw('MONTHNAME(date) month'))
        ->groupBy('year')
        ->groupby('month')
        ->orderBy('year', 'ASC')
        ->orderBy('months', 'ASC')
        ->get();
        //return $abs;
       return view('n.index', compact('notes', 'mdl', 'abs'));
    }
    public function update()
    {
        $lasti = Logs::select('gid')->where('tab', 'ExGnote')->orderBy('gid', 'desc')->first();
        $url = file_get_contents('http://www.uiass-etudiants.ma/api_u3s/web/api/gnote/'.$lasti['gid']);
        $response = json_decode($url, true);
        $gnote = array();
        $ids = [];
        $epr = [];
        $elem_id = [];
        $type_id = [];
        $elem_n = [];
        $type_n = [];
        $lastn = Notes::select('date')->orderBy('date', 'desc')->first();
        foreach ($response as $key => $value) {
            if($value['t_inscription_id'] == "7887"){
                array_push($gnote, $value);
            }
        }
        if (count($response) > 0) {
            $las = end($response);
            $log = new Logs;
            $log->gid = $las['id'];
            $log->tab = 'ExGnote';
            $log->query = $http_response_header;
            $log->save();
        }
        if (count($gnote)>0) {
       // $x = $gnote[count($gnote)-1];
            if ($lastn[0]['date'] < $gnote[0]['date_creation']) {
                foreach ($gnote as $key => $value) {
                    $id = $value['ac_epreuve_id'] - 1;
                    array_push($ids, $id);
                }
                $numb = count($ids);
                for ($i=0; $i < $numb; $i++) {
                    $urli = "http://www.uiass-etudiants.ma/api_u3s/web/api/epreuve/".$ids[$i];
                    $lib = file_get_contents($urli);
                    $responses = json_decode($lib, true);
                    $value2 = $responses[0];
                    $elem = $value2['ac_element_id'] - 1;
                    $type = $value2['id_nature_epreuve'] - 1;
                    array_push($epr, $value2);
                    array_push($elem_id, $elem);
                    array_push($type_id, $type);
                }
                for ($j=0; $j < $numb ; $j++) {
                    $urli = "http://www.uiass-etudiants.ma/api_u3s/web/api/element/".$elem_id[$j];
                    $lib = file_get_contents($urli);
                    $responses = json_decode($lib, true);
                    $value2 = $responses[0]['designation'];
                    array_push($elem_n, $value2);
                }
                for ($k=0; $k < $numb ; $k++) {
                    $urli = "http://www.uiass-etudiants.ma/api_u3s/web/api/natureepreuve/".$type_id[$k];
                    $lib = file_get_contents($urli);
                    $responses = json_decode($lib, true);
                    $value2 = $responses[0]['designation'];
                    array_push($type_n, $value2);
                };
                $counts = count($gnote);
                for ($key=0; $key < $counts ; $key++) {
                        $notes = new Notes;
                        if (isset($gnote[$key]['note'])){
                            $notes->note = $gnote[$key]['note'];
                            if ($gnote[$key]['note'] > "10") {
                                $notes->rattr = "0";
                            }else{
                                $notes->rattr = "1";
                            }
                        }else{
                            $notes->note = "ABS";
                            $notes->rattr = "1";
                        }
                        $notes->element = $elem_n[$key];
                        $notes->code = $epr[$key]['code'];
                        $notes->type = $type_n[$key];
                        $notes->date = $epr[$key]['date_creation'];
                        $notes->tid = $gnote[$key]['t_inscription_id'];
                        $notes->save();

                    }
                    return response()->json([
                        'success' => 'The update was completed successfully'
                    ]);
            }
            else{
                return response()->json([
                    'info' => 'You are updated with logs'
                ]);
            }
    }else{
        return response()->json([
            'info' => 'You are updated without logs'
                    ]);
    }

    }
    public function test(NotesDataTable $dataTable)
    {
        return $dataTable->render('n.test');

    }
    public function api()
    {
        $notes = Notes::all();
        return response()->json(
            ['notes' => $notes]
        );
    }
    public function student()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://www.uiass-etudiants.ma/api_u3s/web/api/etudiant/5000');
        $response = $request->getBody();
        $notes = json_decode($response, true);

        return view('n.search', compact('notes'));
    }
    public function notes($id)
    {
        $client = new \GuzzleHttp\Client();
        $te_id = [];
        $gnote = array();
        $adm_code = array();
        $t_id = array();
        $nid = $id - 1;
        $request = $client->get('http://www.uiass-etudiants.ma/api_u3s/web/api/etudiant/'.$nid);
        $response = $request->getBody();
        $student = json_decode($response, true);
        $code = $student[0]['code'];

        $req = file_get_contents('http://www.uiass-etudiants.ma/api_u3s/web/api/preinscription/10000');
       $j_resp2 = json_decode($req, true);
        //return $['code_etudiant'];
        $cont = count($j_resp2);
        for ($i=0; $i < $cont; $i++) {
            if($j_resp2[$i]['code_etudiant'] == $code)
            array_push($te_id, $j_resp2[$i]['id']);
        }
        $req2 = file_get_contents('http://www.uiass-etudiants.ma/api_u3s/web/api/admission/1000');
        $j_resp3 = json_decode($req2, true);
        $count_adm = count($j_resp3);
        for ($i=0; $i < $count_adm; $i++) {
            if($j_resp3[$i]['t_preinscription_id'] == $te_id[0])
            array_push($adm_code, $j_resp3[$i]['code']);
        }
        $req3 = file_get_contents('http://www.uiass-etudiants.ma/api_u3s/web/api/inscription/1000');
        $j_resp4 = json_decode($req3, true);
        $count_ins = count($j_resp4);
        foreach ($j_resp4 as $key => $value) {
            if ($value['code_admission'] == $adm_code[0]) {
                array_push($t_id, $value['id']);
            }
        }
        $reqs = $client->get('http://www.uiass-etudiants.ma/api_u3s/web/api/gnote/370013');
        $req4 = $reqs->getBody();
        $j_resp5 = json_decode($req4, true);
        foreach ($j_resp5 as $key => $value) {
            if($value['t_inscription_id'] == $t_id[0]){
                array_push($gnote, $value);
            }
        }

        return view('n.student_note', compact('gnote'));

    }
    public function racha()
    {
        $sn = mnote::whereNotNull('note_rachat')->paginate('1000');
        return view('n.ss', compact('sn'));

    }
    public function diag_metro()
    {
        $data = gnote::where('code_epreuve', 'LIKE', 'EPV-ISITS00007118/2019')
                    ->select('note', \DB::raw('COUNT(id) as total'))
                    ->groupBy('note')
                    ->get();
        return view('n.chart', compact('data'));
    }
    public function importExportView()
    {
       return view('n.import');
    }
    public function export()
    {
        return Excel::download(new NotesExport, 'notes.xlsx');
    }
    public function import()
    {
        Excel::import(new NotesImport,request()->file('file'));

        return back();
    }
    public function s()
    {
        $bye = Notes::all()->groupBy(['element','type']);

        foreach ($bye as $key => $value) {
            echo $value['Examen Final'];
        }
    }
    public function all()
    {
        $no = Notes::all();
        return response()->json($no, 200);
    }
    public function ap(Request $request)
    {
        $d = $request->notes;
        $j_resp4 = json_decode($d, true);
        file_put_contents('jso.txt', print_r($j_resp4));
        echo 'done';
    }
    public function enote()
    {
        $query = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/enote/307000");
        $response = json_decode($query, true);
        $es = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/estatut/1");
        $res = json_decode($es, true);
        $d = collect($response)->where('t_inscription_id', '7887')->pluck('statut_def');
        $e = collect($res)->wherein('id',$d);
        $all = collect($response)->where('t_inscription_id', '7887')->zip($e);
        return response()->json($all, 200);
    }
    public function enotes()
    {
        $en = enote::all();
        $data = $en->groupBy('element'); // your data
            $response = [];
            // foreach($data as $key => $e){
            //     foreach ($e as $keys => $d) {

            //     }
            // }
            foreach($data as $key => $row){
                $array = [];
               foreach($row as $keys=>$d){
                if(!is_null($d['id'])){
                    $array['id'] = $d['id'];
                }
                if($d['element'] != "null") {
                    $array['element'] = $d['element'];
                }
                if(!empty($d['m_cc'])) {
                    $array['m_cc'] = $d['m_cc'];
                }
                if(!empty($d['m_tp'])) {
                    $array['m_tp'] = $d['m_tp'];
                }
                if(!empty($d['m_ef'])) {
                    $array['m_ef'] = $d['m_ef'];
                }
                if(!empty($d['r_cc'])) {
                    $array['r_cc'] = $d['r_cc'];
                }
                if(!is_null($d['r_tp'])) {
                    $array['r_tp'] = $d['r_tp'];
                }
                if(!is_null($d['r_ef'])) {
                    $array['r_ef'] = $d['r_ef'];
                }
                if($d['note'] != "null") {
                    $array['note'] = $d['note'];
                }
               }
              $response[] = $array;
            }
            foreach ($response as $key => $value) {
               $en = new enote;
               $en->element = $value['element'];
               if(!empty($value['m_cc'])){
                $en->m_cc = $value['m_cc'];
               }
               if(!empty($value['m_tp'])){
                $en->m_tp = $value['m_tp'];
               }
               if(!empty($value['m_ef'])){
                $en->m_ef = $value['m_ef'];
               }
               if(!empty($value['r_tp'])){
                   $en->r_tp = $value['r_tp'];
               }
               if(!empty($value['r_ef'])){
                $en->r_ef = $value['r_ef'];
               }
               $en->note = "0";
               $en->save();
            }
       return $response;
    }
    public function call()
    {
        $te = enote::all();
        foreach ($te as $value) {
            if ($value->m_cc > $value->r_cc){
                    $cc = $value->m_cc;
                }else{
                    $cc = $value->r_cc;
                }
                if ($value->m_ef > $value->r_ef){
                    $ef = $value->m_ef;
                }else{
                    $ef = $value->r_ef;
                }
                if((!$value->r_tp == '0')){
                    if ($value->m_tp > $value->r_tp){
                        $tp = $value->m_tp;
                    }else{
                        $tp = $value->r_tp;
                    }
                    $id = $value->id;
                    $note = ((float)$tp*0.15 + (float)$cc*0.15 + (float)$ef*0.7);
                    $en = enote::find($id);
                    //echo $cc.' || '.$tp.' || '.$ef;
                    if ($cc < '7' || $tp < '7' || $ef < '7'){
                        $stat = 'ELM Eliminatoire';
                    }elseif ($note < '10') {
                        $stat = 'ELM Non Valide';
                    }else{
                        $stat = 'ELM Valide';
                    }
                    $en->note = number_format($note, 2);
                    $en->statut = $stat;
                    $en->save();
                }else{
                    $note = (((float)$cc)*0.3 + (float)$ef*0.7);
                    if ($cc < '7' || $ef < '7'){
                        $stat = 'ELM Eliminatoire';
                    }elseif ($note < '10.00') {
                        $stat = 'ELM Non Valide';
                    }else{
                        $stat = 'ELM Valide';
                    }
                    $id = $value->id;
                    echo $cc.' |'.$value->element.'| '.$ef.' |SANS TP| </br>';
                    $en = enote::find($id);
                    $en->note = number_format($note, 2);
                    $en->statut = $stat;
                    $en->save();
                }
        }
       //return enote::find('30');
    }
    public function mdl()
    {
        $mdl = \App\module::with('note')->where('semestre', '0')->get();
        return view('n.m', compact('mdl'));
        //return $mdl;
    }
    public function mno()
    {
        $eno = enote::all();
        $all = $eno->groupBy('module_id');
        $c = count($all);
        for ($i=1; $i <= $c; $i++) {
            $a = $all[$i];
            $f = count($a);
            $fin = [];
            $notes = [];
            for ($j=0; $j < $f; $j++) {
                $arr = $a[$j]['coeff'];
                array_push($fin, $arr);
                $note = $a[$j]['note'];
                array_push($notes, $note);
            }
            $coeff = array_sum($fin);
            $coef = array($coeff);
            $mn = new mnote;
            $mn->module_id = $i;
            $mn->save();

        }
       // $result = array_column($all[1], 'coeff');
        //return count($all);
    }
    public function insert()
    {
        $en = Notes::select(DB::raw('SUM(note) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('MONTH(created_at) month'))
        ->groupby('month')
        ->get();
        return $en;
    }
    public function tst1()
    {
        //$lasti = Logs::select('gid')->where('tab', 'ExSnote')->orderBy('gid', 'desc')->first();
        $req = file_get_contents('http://www.uiass-etudiants.ma/api_u3s/web/api/snote/14445');
        $res = json_decode($req, True);
        $exss = collect($res)->where('t_inscription_id', '7887')->where('ac_semestre_id', '143');

        if (!$exss->isEmpty()){
            foreach ($exss as $key => $exs) {
                if(array_key_exists("categorie", $exs)){
                    $es = new \App\Snotes;
                    $es->tid = $exs['t_inscription_id'];
                    $es->sem = $exs['ac_semestre_id'];
                    $es->note = $exs['note'];
                    $es->statut = $exs['statut_def'];
                    $es->save();
                    return response()->json([
                    'success' => "Data Updated Successfully"
                ], 200);
                }else{
                    return response()->json([
                    'info' => "Nothing updated"
                ], 200);
                }

            }

        }else{
            return response()->json([
                'info' => "Nothing updated"
            ], 200);
        }
       // return $exs;
    }
    public function mnoa()
    {
        $req = file_get_contents('http://www.uiass-etudiants.ma/api_u3s/web/api/mnote/89860');
        $res = json_decode($req, true);
        $colle = collect($res)->where('t_inscription_id', '7887');
        return $colle;
    }
    public function upda()
    {
        $abs = \App\Absence::where('date', '0000-00-00')->get();
        if(!$abs->isEmpty()){
            foreach ($abs as $key => $value) {
                $n = $value->ID_Seance;
                $id = $n - 1;
                $req2 = file_get_contents('http://www.uiass-etudiants.ma/api_u3s/web/api/emptime/'.$id);
                $res2 = json_decode($req2, true);
                $date = $res2[0]['start'];
                $ass = \App\Absence::where('ID_Seance', $n)
                                   ->update(['date' => $date]);
            }
            return response()->json([
                'success' => "Data synchonized Successfully"
            ], 200);
        }else{
            return response()->json([
                'info' => "Nothing synchonized"
            ], 200);
        }
    }
    public function abs()
    {
        //$abs = \App\Absence::pluck('ID_Seance');
        $log = Logs::select('gid')->where('tab', 'Absences')->orderBy('gid', 'desc')->first();
        $req = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/absence/".$log['gid']);
        $res = json_decode($req, true);
        $ab = collect($res)->where('ID_Admission', 'ADM-ISITS_IST00003992');
        if (count($res) > "0") {
            $las = end($res);
            $log = new Logs;
            $log->gid = $las['id'];
            $log->tab = 'Absences';
            $log->query = $http_response_header;
            $log->save();
            if (count($ab) > "0") {
            foreach ($ab as $key => $value) {
                $abs = new \App\Absence;
                $abs->ID_Seance = $value['ID_Seance'];
                if (array_key_exists("Date_Pointage", $value)) {
                    $abs->Date_Pointage = $value['ID_Seance'];
                }
                if (array_key_exists("Heure_Pointage", $value)) {
                    $abs->Heure_Pointage = $value['Heure_Pointage'];
                }
                $abs->Categorie = $value['Categorie'];
                $abs->Justifier = $value['Justifier'];
                $abs->Comptabilise = $value['Comptabilise'];
                $abs->date = "Null";
                $abs->save();

             }

             return response()->json([
                'success' => 'The update was completed successfully'
            ]);
        } else{
            return response()->json([
                'info' => 'You are updated with logs'
            ]);
        }
    }
    else{
        return response()->json([
            'info' => 'You are updated without logs'
        ]);
    }
    }
    public function updsn()
    {
        $last = snote::orderBy('id', 'DESC')->first();
        $req = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/snote/13351");
        $res = json_decode($req, True);        //
        foreach ($res as $key => $value) {
            if (array_key_exists("categorie", $value)) {
                $sn = snote::where('id', $value['id'])->update([
                'categorie' => $value['categorie'],
                'categorie_sys' => $value['categorie'],
                'statut' => $value['statut_def'],
                'note' => $value['note'],
                'note_rachat' => $value['note_rachat'],
                'note_sec' => $value['note_sec'],
                'statut_def' => $value['statut_def']
                ]);
                // echo $value['id']."&nbsp;".$value['categorie']."</br>";
            }

        }
        $all = collect($res)->where('t_inscription_id', '7887');
        return response()->json($all, 200);
    }
    public function isi2()
    {
        $is2 = \DB::connection('mysql2')
                    ->table('ex_snotes as exs')
                    ->select(\DB::raw('ins.nom, ins.prenom, exs.note, st.designation, exs.note_rachat'))
                    ->join('t_inscription as ins', 'ins.id_inscription', '=', 'exs.id_inscription')
                    ->join('p_estatut as st', 'st.id', '=', 'exs.statut_def')
                    ->where(\DB::raw('exs.id_semestre'), '143')
                    ->whereBetween(\DB::raw('exs.date_creation'), ['2020-01-01', '2020-03-20'])
                    ->get();
        return response()->json($is2, 200);
    }
    public function users()
    {
        // $adm = \DB::connection('mysql2')
        //             ->table('t_admission')
        //             ->where('id_admission', '>', '3612')
        //             ->select(['id_admission', 'nom', 'prenom'])
        //             ->get();
        // $sas = Hash::make('secret');
        // foreach ($adm as $key => $value) {
        //     $in = $key+3612;
        //     $users = new \App\User;
        //     $users->name = $value->nom.' '.$value->prenom;
        //     $users->email = "demo-".$in."@demo.com";
        //     $users->id = $value->id_admission;
        //     $users->type = "etd";
        //     $users->password = $sas;
        //     $users->id_promotion = '0';
        //     $users->save();
        // }
        $users = \App\User::cursor();
        foreach ($users as $key => $value) {
            $code = \DB::connection('mysql2')
                 ->table('t_admission')
                 ->where('id_admission', $value->id)
                 ->get();
            $final_code = collect($code);
            $us = \DB::connection('mysql2')
                 ->table('t_inscription')
                 ->where('code_admission', 'LIKE', $final_code[0]['code'])
                 ->orderBy('id_inscription', 'Desc')
                 ->first();
            try {
                $user = \App\user::where('id',$value->id)
                            ->update([
                                'email' => $us['mail1'],
                                'id_promotion' => $us['code_promotion']
                            ]);
            } catch (\Throwable $th) {
                    continue;
            }
        }

        return 'Done !!';
    }
    public function idann()
    {
        $id_semestre = snote::where('date_creation', '>', '2019-12-01')->get();
        foreach ($id_semestre as $key => $value) {
            $semestre = Semestre::find($value->id_semestre);
            $promotion = \App\Promos::where('code', $semestre->code_promotion)->first();
            $formation = \App\Forms::where('code', $promotion->code_formation)->first();
            $inscr = \App\Inscription::find($value->id_inscription);
            $annee = Annee::where('code_formation', $formation->code)
                          ->where('validation_academique', 'non')
                          ->first();
            snote::where('id', $value->id)
                ->update([
                    'id_annee' => $annee->id_annee,
                    'code_annee' => $annee->code,
                    'code_inscription' => $inscr->code,
                    'code_preinscription' => $inscr->code_preinscription
                ]);
        }
       return 'Done';
    }
    public function updmnote()
    {
         $req = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/enote/346634");
         $res = json_decode($req, True);
         return response()->json($res[0], 200);
        // $req = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/mnote/89861");
        // $res = json_decode($req, True);
        // foreach ($res as $key => $value) {
        //     $insc = \App\Inscription::find($value['t_inscription_id']);
        //     $mod = \App\mod::find($value['ac_module_id']);
        //       $data = [
        //        'id' => $value['id'],
        //        'id_inscription' => $value['t_inscription_id'],
        //        'code_inscription' => $insc->code,
        //        'code_preinscription' => 'PRE-FMA00006562/2017',
        //        'id_annee' => '226',
        //        'code_annee' => '0',
        //        'id_module' => $value['ac_module_id'],
        //        'code_module' => $mod->code,
        //        'note' => $value['note'],
        //        'note_ini' => $value['note_ini'],
        //        'note_rat' => $value['note_rat'],
        //        'note_rachat' => $value['note_rachat'],
        //        'statut' => null,
        //        'date_creation' => $value['date_creation'],
        //        'statut_s2' => $value['statut_s2'],
        //        'statut_def' => $value['statut_def'],
        //        'statut_aff' => $value['statut_aff']
        //    ];
        //    \App\Mnotes::where('id', $value['id'])->update($data);


        // }
        // return "Done";
    }
    public function userss()
    {
        $us = \App\Inscription::where('code_promotion', 'PRM00000025')->where('code_annee', 'ANN0000000269')->get();
        $pass = Hash::make('1234567890');
        foreach ($us as $key => $value) {
            $user = new \App\User;
            $user->name = $value->nom.' '.$value->prenom;
            $user->email = "isits-".$key.'@uiass.ma';
            $user->password = $pass;
            $user->type = "etd";
            $user->id_promotion = "25";
            $user->save();
        }
    }

}
