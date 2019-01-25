<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $family;
    public $name;
    public $patronymic;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => 'This username has already been taken.'
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['family', 'name', 'patronymic'], 'string'],
            //  [['family', 'name', 'patronymic'], 'required'],
            [
                ['family'],
                'required',
                'when' => function ($model) {
                    return $model->name != null and $model->patronymic != null;
                }
            ],
            [
                ['name'],
                'required',
                'when' => function ($model) {
                    return $model->family != null and $model->patronymic != null;
                }
            ],
            [
                ['patronymic'],
                'required',
                'when' => function ($model) {
                    return $model->family != null and $model->name != null;
                }
            ],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => 'This email address has already been taken.'
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->name = $this->name;
        $user->family = $this->family;
        $user->patronymic = $this->patronymic;
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
