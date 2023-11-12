<?php

use yii\db\Migration;

/**
 * Class m231109_101334_addTableLead
 */
class m231109_101334_addTableLead extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lead', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150),
            'phone' => $this->string(20),
            'email' => $this->string(150),
            'message' => $this->string(1024),
            'accept_marketing_email' => $this->tinyInteger()->defaultValue(0),
            'send' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'metadata' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lead');

        echo "m231109_101334_addTableLead cannot be reverted.\n";

        return true;
    }
}
