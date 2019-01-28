<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userSubscription".
 *
 * @property int $id
 * @property int $user_id
 * @property int $subscribion_id
 * @property string $enddate
 *
 * @property Subscription $subscribion
 * @property User $user
 */
class UserSubscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'subscribion_id'], 'integer'],
            [['enddate'], 'safe'],
            [['subscribion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subscription::className(), 'targetAttribute' => ['subscribion_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'subscribion_id' => 'Subscribion ID',
            'enddate' => 'Enddate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscribion()
    {
        return $this->hasOne(Subscription::className(), ['id' => 'subscribion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
