<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use common\models\User;
use app\models\SignupForm;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
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
     * Renders the index get for the module
     *
     * @return string
     */
    public function actionGet()
    {
        $users = User::find()->all();
        $userArray = ArrayHelper::toArray($users);
        $json = ArrayHelper::toArray($userArray);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $json;
        //  $items = ['some', 'array', 'of', 'data' => ['associative', 'array']];
        //  return $items;
    }

    /**
     * Renders the index get for the module
     *
     * @return string
     */
    public function actionTest()
    {
        return $this->render('index');
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEdit($id)
    {
        /*   if ($model->load(Yii::$app->request->post()) && $model->save()) {

           }*/
        $model = User::find()->where(['id' => $id])->one();
        //  $model=SignupForm::findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            // var_dump(Yii::$app->request->post());
            $post = Yii::$app->request->post();
            $user = User::find()->where(['id' => $id])->one();

            $user_post = $post["User"];

            //$username
            $user->username = $user_post["username"];
            $user->email = $user_post["email"];
            $user->family = $user_post["family"];
            $user->patronymic = $user_post["patronymic"];
            if ($user_post["password"] != null) {
                try {
                    $hash = Yii::$app->getSecurity()->generatePasswordHash($user_post["password"]);
                    $user->password_hash = $hash;
                } catch (Exception $e) {
                }
            }
            $user->save();
            //model->username=$user->username;


        } else {
            // validation failed: $errors is an array containing error messages
            // and just for debug var_dump  the errors
            $errors = $model->errors;

        }

        /* if ($model->load(Yii::$app->request->post()) ) {
             $requvest=Yii::$app->request->post();
             var_dump($requvest);
             $username=$requvest->User->username;
             var_dump($username);
             $user = User::find()->where(['id' => $id])->one();
             $user->username=$requvest->user->username;
             $user->email=$requvest->user->email;
             $user->save(false);
             die();
         }*/

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    function vardump($var)
    {
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }

}
