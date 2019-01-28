<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 17.01.2019
 * Time: 22:04
 */

namespace api\controllers;

use common\models\User;
//use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);

        return $actions;
    }


    public function behaviors()
    {
        /*    $behaviors = parent::behaviors();
            $behaviors['authenticator']['class'] = HttpBasicAuth::className();
            $behaviors['authenticator']['auth'] = function ($username, $password) {
                return \app\models\User::findOne([
                    'username' => $username,
                    'password' => $password,
                ]);
            };*/
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
        ];
        return $behaviors;
    }


    public function actionSingup()
    {
        $model = new SignupForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($user = $model->signup()) {
                $this->sentEmailConfirm($user);
                return $this->redirect(['site/index']);
            }
        }
        return $this->render('signup', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/index']);
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['site/index']);
    }

    //send mail for confurm email adress
    public function actionEmail($user)
    {
        $mail = $user->email;
        try {
            Yii::$app->mailer->compose(['html' => '@app/mail/html'], ['token' => $user->emailToken])
                ->setFrom('sakura-testmail@sakura-city.info')
                ->setTo($mail)
                ->setSubject('Please, confurm you email')
                ->send();
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }


    public function actionIndex()
    {
        $users = User::find()->select(['id', 'family', 'name', 'patronymic', 'enddate'])->all();
        $json = Json::encode($users);
        $array = json_decode($json, true);
        foreach ($array as $key => $item) {
            // unset them
            $fio = $array[$key]["family"] . "&" . $array[$key]["name"] . "&" . $array[$key]["patronymic"];
            unset($array[$key]["family"]);
            unset($array[$key]["name"]);
            unset($array[$key]["patronymic"]);
            $array[$key]["fio"] = $fio;
        }

        $json = Json::encode($array);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $json;
    }

    public function actionView($id)
    {
        $users = User::find()->select(['id', 'family', 'name', 'patronymic', 'enddate'])->where(['id' => $id])
            ->one();;
        $json = Json::encode($users);
        $array = json_decode($json, true);
        //costom json filds for out
        $fio = $array["family"] . "&" . $array["name"] . "&" . $array["patronymic"];
        unset($array["family"]);
        unset($array["name"]);
        unset($array["patronymic"]);
        $array["fio"] = $fio;
        $json = Json::encode($array);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $json;
    }

    public function actionUpdate($id)
    {

        $request = Yii::$app->request;
        $post = $request->post();
        //    var_dump($post);

        $users = User::find()->select([
            'id',
            'username',
            'family',
            'name',
            'patronymic',
            'enddate'
        ])->where(['id' => $id])
            ->one();;

        if ($post["email"] != null) {
            $users["email"] = $post->email;
        }

        if ($post["password"] != null) {
            $hash = Yii::$app->getSecurity()->generatePasswordHash($post['password']);
            $users["password"] = $hash;
        }
        if ($post["status"] != null) {
            $users["status"] = $post['status'];
        }

        if ($post["family"] != null) {
            $users["family"] = $post["family"];
        }

        if ($post["name"] != null) {
            $users["name"] = $post["name"];
        }
        if ($post["family"] != null) {
            $users["family"] = $post["family"];
        }

        if ($post["patronymic"] != null) {
            $users["patronymic"] = $post["patronymic"];
        }

        if ($post["enddate"] != null) {
            $users["enddate"] = $post["enddate"];
        }


        $users->save(false);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }



}