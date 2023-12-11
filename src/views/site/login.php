<?php
/** @var User $model */

use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$host = Yii::$app->params['host'];
$logo = $host . '/web/images/logo.png';

?>

<div class="col-sm-5"></div>
    <div class="col-sm-2" style="margin-top: 100px;">

        <img src="<?= $logo ?>" alt="" style="width: 100%; padding: 25px"/>
        <h4 style="color: #888; " class="text-center">Login</h4>
        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'user')->textInput([
                'autofocus' => true,
                'placeholder' => 'Usuário'
            ])->label(false) ?>
    
            <?= $form->field($model, 'pass')->passwordInput([
                'placeholder' => 'Senha'
            ])->label(false) ?>
    
            <div class="form-group">
                <?= Html::submitButton('Acessar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
<div class="col-sm-5"></div>
