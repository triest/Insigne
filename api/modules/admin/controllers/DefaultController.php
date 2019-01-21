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

    function actionEdit($id)
    {
        $model = User::find($id)->one();
        /*   if ($model->load(Yii::$app->request->post()) && $model->save()) {
           }*/
        $requvest = Yii::$app->request->post();
        $model = User::find()->where(['id' => $id])->one();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
            } else {
                // validation failed: $errors is an array containing error messages
                // and just for debug var_dump  the errors
                $errors = $model->errors;
                var_dump($errors);
                die();
            }
            $model->save(false);
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
