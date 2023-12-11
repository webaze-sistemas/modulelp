<?php
/** @var \webaze\modulelp\models\forms\LeadForm $form */


$this->registerJs('__dashboard()');
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