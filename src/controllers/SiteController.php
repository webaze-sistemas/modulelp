<?php

namespace webaze\modulelp\controllers;

use app\models\managers\LoginManager;
use yii\web\Controller;
use webaze\modulelp\models\Click;
use webaze\modulelp\models\Lead;
use Yii;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $model = new Lead();

        $params = Yii::$app->request->queryParams;
        Click::saveClick($params);

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->load($post);
            $model->save();

            $params['lead_id'] = (string) $model->id;
            Click::saveClick($params, true);

            Yii::$app->session->setFlash('cadastro-ok', $model->name);
            return $this->redirect(['site/ok']);
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionOk()
    {
        $name = Yii::$app->session->getFlash('cadastro-ok');
        if (!$name) {
            return $this->redirect(['site/index']);
        }

        return $this->render('ok', [
            'name' => $name
        ]);
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionLogin()
    {
        $this->layout = 'main';

        $model = new LoginManager();

        if ($cookie = \Yii::$app->request->cookies->getValue('user')) {
            if ($cookie['id'] > 0) {
                return $this->redirect(['adm/dashboard/index']);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['adm/dashboard/index']);
        }

        $model->pass = '';
        return $this->render('login', [
            'model' => $model,
        ]);

    }
}

