<?php

namespace App\Steps\Matiere;

use App\matiere;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Ycs77\LaravelWizard\Step;

class MatiereStep extends Step
{
    /**
     * The step slug.
     *
     * @var string
     */
    protected $slug = 'matiere';

    /**
     * The step show label text.
     *
     * @var string
     */
    protected $label = 'Matiere';

    /**
     * The step form view path.
     *
     * @var string
     */
    protected $view = 'steps.matiere.matiere';

    /**
     * Set the step model instance or the relationships instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|null
     */
    public function model(Request $request)
    {
        return new matiere;
    }

    /**
     * Save this step form data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array|null  $data
     * @param  \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|null  $model
     * @return void
     */
    public function saveData(Request $request, $data = null, $model = null)
    {
        $data = Arr::only($data, 'matiere');
        //$model->insert($data);
        Matiere::create($data);
    }

    /**
     * Validation rules.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'matiere' => 'required',
        ];
    }
}
