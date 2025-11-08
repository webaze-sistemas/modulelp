<?php

namespace webaze\modulelp\controllers\adm;


use app\components\AdmController;
use webaze\modulelp\components\adm\Controller;
use webaze\modulelp\models\forms\LeadForm;
use Yii;

class DashboardController extends Controller
{
    public $layout = 'admin';

    public function actionIndex()
    {
        $form = new LeadForm();
        $form->searchQuery = Yii::$app->request->get();

        return $this->render('/adm/dashboard/index', [
            'form' => $form
        ]);
    }
}
