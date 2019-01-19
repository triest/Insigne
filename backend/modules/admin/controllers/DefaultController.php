<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\ArrayHelper;
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

    public function actionEdit($id)
    {

        $model = User::find()->where(['id' => $id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['', 'id' => $model->getId()]);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }
}
