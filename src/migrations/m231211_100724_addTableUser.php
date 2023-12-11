<?php

use yii\db\Migration;

/**
 * Class m231211_100724_addTableUser
 */
class m231211_100724_addTableUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'status' => $this->tinyInteger()->defaultValue(1),
            'user' => $this->string(),
            'pass' => $this->string()
        ]);

        $this->insert('user', [
            'name' => 'Webaze',
            'user' => 'Webaze',
            'pass' => md5('wbz2023')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');

        echo "m231211_100724_addTableUser cannot be reverted.\n";

        return true;
    }
}
