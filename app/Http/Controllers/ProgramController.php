<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\program;
class ProgramController extends Controller
{
    public function index()
    {
        $pro = program::where('annuler', '0')->get();
        return view('pr.index', compact('pro'));
    }
    public function update()
    {
        $pro = program::where('annuler', '0')->wherenull('module')->get();
        if (!$pro->isEmpty()) {
            foreach ($pro as $key => $value) {
                $md = $value->produc['id_module'];
                $mdl = \DB::connection('mysql2')->table('ac_module')->where('code', $md)->get();
                $el = $value->produc['id_element'];
                $ele = \DB::connection('mysql2')->table('ac_element')->where('code', $el)->get();
                foreach ($mdl as $key => $module) {
                    $modi = program::where('id', $value->id)->update([
                        'module' => $module->designation
                    ]);
                }
                foreach ($ele as $key => $element) {
                    $modi = program::where('id', $value->id)->update([
                        'element' => $element->designation
                    ]);
                }
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
    public function load()
    {
        $lasti = \App\Logs::select('gid')->where('tab', 'Program')->orderBy('gid', 'desc')->first();
        $req = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/emptime/".$lasti['gid']);
        $pro = \DB::connection('mysql2')->table('pr_programmation')->where('id_semestre', "SEM00000144")->pluck('id');
        $res = json_decode($req, True);
        $coll = collect($res)->whereIn('pr_programmation_id', $pro);
        if (count($res) > "0") {
            $las = end($res);
            $log = new \App\Logs;
            $log->gid = $las['id'];
            $log->tab = 'Program';
            $log->query = $http_response_header;
            $log->save();
            if (count($coll) > "0") {
                foreach ($coll as $key => $value) {
                    $pro = new program;
                    if(! empty($value['description'])){
                        $pro->description = $value['description'];
                    }else{
                        $pro->description = "Null";
                    }
                    if(! empty($value['semaine'])){
                        $pro->semaine = $value['semaine'];
                    }else{
                        $pro->semaine = "Null";
                    }
                    if(! empty($value['start'])){
                        $pro->start = $value['start'];
                    }else{
                        $pro->start = "Null";
                    }
                    if(! empty($value['end'])){
                        $pro->end = $value['end'];
                    }else{
                        $pro->end = "Null";
                    }
                    if(! empty($value['code_salle'])){
                        $pro->code_salle = $value['code_salle'];
                    }else{
                        $pro->code_salle = "Null";
                    }
                    $pro->pr_programmation_id = $value['pr_programmation_id'];
                    $pro->annuler = $value['annuler'];
                    $pro->save();
                }
                return response()->json([
                    'success' => "Data Updated Successfully"
                ], 200);
            }else {
                return response()->json([
                    'info' => "Nothing updated with Logs"
                ], 200);
            }
        }else{
            return response()->json([
                'info' => "Nothing updated without logs"
            ], 200);
        }
    }
    public function test()
    {
        $pro = \DB::connection('mysql2')->table('pr_programmation')->orderBy('id', 'desc')->get();
        foreach ($pro as $key => $value) {
            if ($key == '0') {
                $id = $value->id;
                $req = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/programme/".$id);
                $res = json_decode($req, True);
                foreach ($res as $key => $value) {
                    try {
                        $s = \App\Prog::create($value);
                        $s->save;
                    } catch (\Throwable $th) {
                    }

                }

            }
        }
        // $req = file_get_contents("http://www.uiass-etudiants.ma/api_u3s/web/api/emptime/67400");
        // $res = json_decode($req, True);
        // return $pro;
    }
}
