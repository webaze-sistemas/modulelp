<?php
/** @var \webaze\modulelp\models\forms\LeadForm $form */

use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->registerJs('__dashboard()');

$icon = <<< HTML
<div class="input-group-addon">
    <span class="input-group-text">
        <i class="fa fa-calendar"></i>
    </span>
</div>
HTML;

$periodSearch = ArrayHelper::getValue($form->getFilters(), 'pe');

?>

<div id="info" class="tab-pane fade in active">
    <div class="section-body">

        <form id="form-filteraaa" class="form-inline" method="get" action="?">
            <div class="row" style="margin-bottom: 30px">
                <div class="col-sm-3">
                    <label>Data</label>
                    <div class="input-group" style="width:100%; z-index: 0">
                        <?= DateRangePicker::widget([
                                'name' => 'pe',
                                'value' => $periodSearch,
                                'convertFormat' => true,
                                'useWithAddon' => true,
                                'pluginOptions' => [
                                        'locale' => ['format' => 'd/m/Y'],
                                        'ranges' => [
                                                Yii::t('app', 'Hoje') => ["moment().startOf('day')", 'moment()'],
                                                Yii::t('app', 'Ontem') => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
                                                Yii::t('app', 'Últimos {n} Dias', ['n' => 7]) => ["moment().startOf('day').subtract(6, 'days')", 'moment()'],
                                                Yii::t('app', 'Últimos {n} Dias', ['n' => 30]) => ["moment().startOf('day').subtract(29, 'days')", 'moment()'],
                                                Yii::t('app', 'Este Mês') => ["moment().startOf('month')", 'moment().endOf(\'month\')'],
                                                Yii::t('app', 'Último Mês') => ["moment().subtract(1, 'month').startOf('month')", 'moment().subtract(1, \'month\').endOf(\'month\')'],
                                                Yii::t('app', 'Todo Período') => ["moment().startOf('day').subtract(5, 'years')", "moment().startOf('day').add(5, 'years')"],
                                        ],
                                ],
                        ]);
                        echo $icon ?>
                    </div>
                </div>

                <div class="col-sm-" style="padding-left:0;">
                    <?= Html::button('<i class="fa fa-search"></i>', [
                            'class' => 'btn btn-default',
                            'type' => 'submit',
                            'style' => 'margin-top: 20px'
                    ]);?>
                </div>
            </div>
        </form>

        <div class="panel">
            <?= \webaze\modulelp\components\grid\GridView::widget([
                'dataProvider' => $form->getActiveDataProvider(),
                'columns' => $form->getColumns()
            ]) ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    function __dashboard() {
        $('.message').on('click', function () {
            var message = $(this).attr('data-message'),
                $modalMessage = $('.modal-message');


            $modalMessage.html('')
            $modalMessage.html(message)

            $('#modal-message').modal('show')
        });
    }
</script>

<div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p class="modal-message"></p>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>