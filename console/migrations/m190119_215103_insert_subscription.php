<?php

use yii\db\Migration;

/**
 * Class m190119_215103_insert_subscription
 */
class m190119_215103_insert_subscription extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('subscription', [
            'name' => 'sub1',
        ]);
        $this->insert('subscription', [
            'name' => 'sub2',
        ]);
        $this->insert('subscription', [
            'name' => 'sub3',
        ]);
        $this->insert('subscription', [
            'name' => 'sub4',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('subscription', ['id' => 1]);
        $this->delete('subscription', ['id' => 2]);
        $this->delete('subscription', ['id' => 3]);
        $this->delete('subscription', ['id' => 4]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190119_215103_insert_subscription cannot be reverted.\n";

        return false;
    }
    */
}
