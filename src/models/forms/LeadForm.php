<?php

namespace webaze\modulelp\models\forms;

use webaze\modulelp\models\Lead;
use yii\helpers\ArrayHelper;

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

        return $rows;
    }

    public function getFilters()
    {
        return $this->setFilters(['q' => null, 'p' => null, 's' => -1]);
    }

    protected function getDataColumns()
    {
        return [
            'name' => ['label' => 'Nome'],
            'email' => ['label' => 'E-Mail'],
            'phoneFormatted' => ['label' => 'Fone'],
            'message' => ['label' => 'Mensagem'],
        ];
    }
}