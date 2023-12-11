<?php

use yii\helpers\Url;
use yii\widgets\Menu;

$colorMenu = 'background: rgba(0,63,94,0.9)';


$host = Yii::$app->params['host'];
$logo = $host . '/web/images/logo.png';
?>

<header id="header-container" style="background: <?= $colorMenu ?> !important;">
    <div class="navbar" id="navbar-header-component">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?=Url::to(['site/index'])?>" class="logo flex">
                    <img style="height: 50px" src="<?= $host ?>/web/images/rocket.png" alt="logo">
                </a>
            </div>

            <nav id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/site/logout">Sair</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

