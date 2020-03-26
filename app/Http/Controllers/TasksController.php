<?php

namespace App\Http\Controllers;

use App\Tasks;
use App\matiere;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
       $taches = Tasks::all();
       $matiere = matiere::where('semestre', '144')->get();
       return view('task.index', compact('taches', 'matiere'));
    }
    public function store(Request $request)
    {
        $start = Carbon::createFromFormat('d/m/Y H:i', $request->esdate)->format('Y-m-d h:i');
        $end = Carbon::createFromFormat('d/m/Y H:i', $request->eedate)->format('Y-m-d h:i');
        $task = new Tasks;
        $task->matiere_id = $request->input('ename');
        $task->level = '1';
        $task->content = $request->input('edesc');
        $task->start_at = $start;
        $task->end_at = $end;
        $task->active = '1';
        $task->save();
        return back()->with('success', 'La tache est bien soumis');
    }
}
