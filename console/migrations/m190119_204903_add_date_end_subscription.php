<?php

use yii\db\Migration;

/**
 * Class m190119_204903_add_date_end_subscription
 */
class m190119_204903_add_date_end_subscription extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      //  $this->addColumn('user', 'enddate', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    //    $this->dropColumn('user', 'isAdmin');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190119_204903_add_date_end_subscription cannot be reverted.\n";

        return false;
    }
    */
}
