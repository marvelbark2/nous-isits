<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MattDaneshvar\Survey\Models\Entry;
use MattDaneshvar\Survey\Models\Survey;
Use Alert;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::orderBy('created_at', 'Desc')->cursor();
        return view('survey.index', compact('surveys'));

    }
    public function show(Survey $survey)
    {
        return view('survey.show', compact('survey'));
    }
    public function create()
    {
        return view('survey.new');
    }
    public function store(Request $request)
    {
        $survey = Survey::create(['name' => $request->input('title')]);
        $multi = $request->input('multi');
        if($multi){
            $one = $survey->sections()->create(['name' => 'Part One']);

            $one->questions()->create([
                'content' => 'How many cats do you have?',
                'type' => 'number',
                'rules' => ['numeric', 'min:0']
            ]);

            $two = $survey->sections()->create(['name' => 'Part Two']);

            $two->questions()->create([
                'content' => 'What\'s the name of your first cat?',
            ]);

            $two->questions()->create([
                'content' => 'Would you want a new cat?',
                'type' => 'radio',
                'options' => ['Yes', 'Oui']
            ]);
        }else{
            $survey->questions()->create([
                'content' => $request->input('question'),
                'type' => 'radio',
                'options' => $request->input('options')
            ]);
        }
         return Alert::success('Tres Bien !', 'le sondage est bien cree');


    }
    public function answers(Survey $survey, Request $request)
    {
        $answers = $request->all();
        unset($answers['_token']);
        (new Entry)->for($survey)->by(Auth::user())->fromArray($answers)->push();

        return redirect('/survey')->with('toast_success', 'Votre reponse est bien soumis');
    }
    public function data(Request $request)
    {
        return "test";
    }
}
