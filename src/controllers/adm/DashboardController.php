<?php

namespace webaze\modulelp\controllers\adm;


use app\components\AdmController;
use webaze\modulelp\components\adm\Controller;
use webaze\modulelp\models\forms\LeadForm;

class DashboardController extends Controller
{
    public $layout = 'admin';

    public function actionIndex()
    {
        $form = new LeadForm();

        return $this->render('/adm/dashboard/index', [
            'form' => $form
        ]);
    }
}
