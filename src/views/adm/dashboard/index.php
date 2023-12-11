<?php
/** @var \webaze\modulelp\models\forms\LeadForm $form */


?>

<div id="info" class="tab-pane fade in active">
    <div class="section-body">
        <div class="panel">
            <?= \webaze\modulelp\components\grid\GridView::widget([
                'dataProvider' => $form->getActiveDataProvider(),
                'columns' => $form->getColumns()
            ]) ?>
        </div>
    </div>
</div>