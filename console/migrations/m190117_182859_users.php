<?php

use yii\db\Migration;

/**
 * Class m190117_182859_users
 */
class m190117_182859_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'family', $this->string()->defaultValue(null));
        $this->addColumn('user', 'patronymic', $this->string()->defaultValue(null));
        $this->addColumn('user', 'name', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'family');
        $this->dropColumn('user', 'patronymic');
        $this->dropColumn('user', 'name');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190117_182859_users cannot be reverted.\n";

        return false;
    }
    */
}
