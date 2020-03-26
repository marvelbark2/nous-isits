<?php

namespace App\Http\Controllers;

use App\Steps\Matiere\MatiereStep;
use App\Steps\Matiere\ModuleStep;
use Ycs77\LaravelWizard\Wizardable;

class MatiereWizardController extends Controller
{
    use Wizardable;

    /**
     * The wizard name.
     *
     * @var string
     */
    protected $wizardName = 'matiere';

    /**
     * The wizard title.
     *
     * @var string
     */
    protected $wizardTitle = 'Matiere';

    /**
     * The wizard options.
     *
     * @var array
     */
    protected $wizardOptions = [];

    /**
     * The wizard steps instance.
     *
     * @var array
     */
    protected $steps = [
        ModuleStep::class,
        MatiereStep::class,
    ];
}
