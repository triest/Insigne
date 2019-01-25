<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 17.01.2019
 * Time: 22:07
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Security;
use yii\base\CSecurityManager;

class EditForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $family;
    public $name;
    public $patronymic;
    public $phone;
    public $password_repeat;
    public $verifyCode;

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            [['username'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
            [['username'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'username'],
            [
                ['family'],
                'required',
                'when' => function ($model) {
                    return $model->name != null || $model->patronymic != null;
                },
            ],
            [
                ['name'],
                'required',
                'when' => function ($model) {
                    return $model->family != null || $model->patronymic != null;
                },
            ],
            [
                ['patronymic'],
                'required',
                'when' => function ($model) {
                    return $model->family != null || $model->name != null;
                },
            ],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }


    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;
            $hash = Yii::$app->getSecurity()->generatePasswordHash($user->password);
            $user->password = $hash;
            $user->emailToken = Yii::$app->security->generateRandomString(32);
            // $this->endConfurmEmail($user->mail, $user->emailToken);

            $user->create();
            return $user;
        }
    }

    public function sendConfurmEmail($email, $token)
    {


        Yii::$app->mailer->compose(['html' => '@app/mail/html'], ['token' => $token])
            ->setFrom('sakura-testmail@sakura-city.info')
            ->setTo($email)
            ->setSubject('Please confurm you email')
            ->send();
    }

}