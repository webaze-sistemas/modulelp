<?php

namespace webaze\modulelp\models\forms;

use webaze\modulelp\models\Lead;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class LeadForm extends \webaze\modulelp\components\Report
{

    protected function getData()
    {
        $rows = Lead::find()->orderBy(['id' => SORT_DESC]);
        $filters = $this->getFilters();

        if ($q = ArrayHelper::getValue($filters, 'q')) {
            $rows->andWhere([
                'OR',
                ['LIKE', 'name', $q],
            ]);
        }

        if (!empty($filters['pe'])) {
            $exp = explode(' - ', $filters['pe']);

            $start = self::toDbDate($exp[0]);
            $end = self::toDbDate($exp[1]);

            $rows->andWhere(['between', 'created_at',  $start, $end]);
        }

        return $rows;
    }

    public function getFilters()
    {
        $filter = $this->searchQuery;

        if (!isset($filter['pe'])) {
            $filter['pe'] = date('d/m/Y', strtotime('-29 day')) . ' - ' . date('d/m/Y');
        }

        return $filter;// $this->setFilters(['q' => null, 'p' => null, 's' => -1]);
    }

    protected function getDataColumns()
    {
        return [
            'name' => [
                'label' => 'Nome / email',
                'format' => 'raw',
                'value' => function (Lead $model) {
                    return "<b>{$model->name}</b> <br> <small>{$model->email}</small>";
                }
            ],

            'date' => [
                'label' => 'Data',
                'format' => 'raw',
                'value' => function (Lead $model) {
                    return \Yii::$app->formatter->asDate($model->created_at, 'php:d/m/Y H:i') . ' <br> ' .
                        \Yii::$app->formatter->asRelativeTime($model->updated_at);
                }
            ],

            'phoneFormatted' => ['label' => 'Fone'],
            'message' => [
                'label' => 'Mensagem',
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'fw-600 text-nowrap',
                ],
                'value' => function (Lead $model) {
                    $message = str_replace("\n", '<br>', $model->message);
                    return Html::tag('span', substr($model->message, 0, 50) . '...', [
                        'data-message' => $message,
                        'class' => 'message',
                        'data-toggle' => 'tooltip',
                        'title' => 'Clique para a mensagem completa',
                        'data-placement' => 'left'
                    ]);
                }
            ],
        ];
    }
}