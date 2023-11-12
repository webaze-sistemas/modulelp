<?php

use yii\db\Migration;

/**
 * Class m210703_185408_table_config_site
 */
class m210703_185408_table_config_site extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('config', [
            'id' => $this->primaryKey(),
            'receive_email' => $this->string(),
            'phone_1' => $this->string(),
            'phone_2' => $this->string(),
            'description' => $this->string(),
            'key_words' => $this->string(),
            'title' => $this->string(),
            'metadata' => $this->text(),
        ]);

        $this->insert('config', [
            'description' => 'Webaze Marketing',
            'key_words' => 'Webaze Marketing',
            'title' => 'Webaze Marketing',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('config');

        return true;
    }
}
