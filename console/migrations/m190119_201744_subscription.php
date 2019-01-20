<?php

use yii\db\Migration;

/**
 * Class m190119_201744_subscription
 */
class m190119_201744_subscription extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subscription', [
            'id' => $this->primaryKey(),
            'name' => $this->string()]);
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subscription');
    }
}
