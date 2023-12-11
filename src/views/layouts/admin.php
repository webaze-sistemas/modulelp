<?php
/* @var $this \yii\web\View */
/* @var $content string */

use webaze\modulelp\components\adm\assets\AdmAsset;
use yii\helpers\Html;

AdmAsset::register($this);

$host = Yii::$app->params['host'];
$logo = $host . '/web/images/logo.png';

$this->registerJs('__global()');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" sizes="32x32" href="<?= $host ?>/web/images/logo.png">

    <style>
        .pl-0 {
            padding-left: 0 !important;
            padding-right: 10px !important;
        }
    </style>

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script type="text/javascript">
        function __global() {
            $('[data-toggle=tooltip]').tooltip()
            var $doc = $('html, body');

            $('.link-menu').click(function () {
                var altura = ($($.attr(this, 'href')).offset().top - 120);
                $doc.animate({
                    scrollTop: altura
                }, 750);

                return false;
            });
        }
    </script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $this->render('_menu'); ?>

    <div class="container-fluid">
        <?= $content ?>
    </div>
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-right">Webaze</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
