<?php

use yii\db\Migration;

/**
 * Class m190119_214621_add_date_end_subscription_add_end_date
 */
class m190119_214621_add_date_end_subscription_add_end_date extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('userSubscription', 'enddate', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('userSubscription', 'isAdmin');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190119_214621_add_date_end_subscription_add_end_date cannot be reverted.\n";

        return false;
    }
    */
}
