<?php

namespace webaze\modulelp\controllers;

use yii\web\Controller;

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
}
