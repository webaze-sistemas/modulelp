<?php

use yii\db\Migration;

/**
 * Class m231109_110116_addTableClick
 */
class m231109_110116_addTableClick extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('click', [
            'id' => $this->primaryKey(),
            'metadata' => $this->text(),
            'lead_id' => $this->string(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('click');

        echo "m231109_110116_addTableClick cannot be reverted.\n";

        return true;
    }
}
