<?php

use yii\db\Migration;

/**
 * Class m190119_202823_user_subscription
 */
class m190119_202823_user_subscription extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('userSubscription', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'subscribion_id' => $this->integer()
        ]);
        // creates index for column `user_id`
        $this->createIndex(
            'idx_user_id',
            'userSubscription',
            'user_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'user_subscrition_user_id',
            'userSubscription',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        // creates index for column `user_id`
        $this->createIndex(
            'idx_subscription_id',
            'userSubscription',
            'subscribion_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'review_review_review_id',
            'userSubscription',
            'subscribion_id',
            'subscription',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('userSubscription');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190119_202823_user_subscription cannot be reverted.\n";

        return false;
    }
    */
}
