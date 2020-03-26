<?php

namespace App\Http\Controllers;

use PDF;
use App\QE;
use App\User;
use App\matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Alert;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;

class QeController extends Controller
{
    public function list(ModelFilters $modelFilters, Request $request)
    {

          if (!empty($modelFilters->filters())) {

              $perpage = $request->input('perpage');
              $request->offsetUnset('perpage');
              $users = \App\QE::filter($modelFilters)->with('matiere')->orderByDesc('id')->paginate($perpage,['*'],'page');
              return $users;
          } else {
              $users = \App\QE::with('matiere')->orderByDesc('id')->paginate(10);
              return $users;
          }

    }
    public function index()
    {
        $matiere = \App\matiere::all();
        return view('qe.index', compact('matiere'));
    }
    public function md(matiere $m_id)
    {
        $users = User::all();
        request()->session()->regenerateToken();
       return view('qe.add', compact('m_id', 'users'));
    }
    public function create(matiere $m_id)
    {
        $users = User::all();
        request()->session()->regenerateToken();
        return view('qe.create', compact('m_id', 'users'));
    }
    public function store(request $request)
    {
        $qe = \App\QE::create([
            'matiere_id' => $request->input('m_id'),
            'questionn' => $request->input('questionn'),
            'content' => $request->input('content'),
            'type' => $request->input('type'),
            'user_id' => Auth::user()->id
            ]);
        $qe_u = new \App\Qe_user;
            $qe_u->qe_id = $qe->id;
            $qe_u->user_id = Auth::id();
            $qe_u->save();
        $qe->save();
        return back()->with('toast_success', 'QE Saved successfully');
    }
    public function show(QE $id)
    {
        $users = User::all();
        $all = QE::with('comments')->get();
        return view('qe.show', compact('id', 'users'));
        // $comments = array();
        // foreach ($all as $key => $value) {
        //     $co = $value->comments;
        //     echo $co;
        // }
    }
    public function print(matiere $m_id)
    {
        $pdf = PDF::loadView('qe.print', array('m_id' => $m_id));
        return $pdf->stream();
        //return $pdf->download($m_id->matiere.'-QE.pdf');

    }
    public function edit(QE $id)
    {
        return view('qe.edit', compact('id'));
    }
    public function update(QE $id, Request $request)
    {
        $m_id = $request->input('m_id');
        $id->questionn = $request->input('questionn');
        $id->matiere_id = $m_id;
        $id->content = $request->input('content');
        $id->type = $request->input('type');
        $id->save();
        return redirect('/qe/'.$m_id)->with('toast_success', 'Qe updated succesfully');
    }
    public function invite(Request $request, Qe $qe)
    {
        foreach ($request->get('user') as $key => $value) {
            $qe_u = new \App\Qe_user;
            $qe_u->qe_id = $qe->id;
            $qe_u->user_id = $value;
            $qe_u->save();
        }
        return back()->with('toast_success', 'Operation est bien effectuee');

    }
}
