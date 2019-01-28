<?php

namespace app\modules\admin\controllers;

use app\models\Subscription;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use common\models\User;
use app\models\SignupForm;
use app\models\EditForm;



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
        $model2 = User::find()->where(['id' => $id])->one();
        $model = new EditForm();
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();

            $user_post = $post["EditForm"];
            $user = User::find()->where(['id' => $id])->one();
            $user->username = $user_post["username"];
            $user->email = $user_post["email"];
            $user->family = $user_post["family"];
            $user->patronymic = $user_post["patronymic"];
            $subscription = Yii::$app->request->post('subscription');
            $user->saveSubscription($subscription);
            if ($user_post["password"] != null) {
                try {
                    $hash = Yii::$app->getSecurity()->generatePasswordHash($user_post["password"]);
                    $user->password_hash = $hash;
                } catch (Exception $e) {
                }
            }
            $user->save(false);
            $model2 = User::find()->where(['id' => $id])->one();
        } else {
            $errors = $model->errors;
        }
        $model->username = $model2->username;
        $model->email = $model2->email;
        $model->name = $model2->name;
        $model->patronymic = $model2->patronymic;
        $model->family = $model2->family;
        $subscrition = ArrayHelper::map(Subscription::find()->all(), 'id', 'name');
        $selectedSubs = $model2->getSelectedSubscription();

        return $this->render('edit', [
            'model' => $model,
            'Subscription' =>$subscrition,
            'selectedSubscription'=>$selectedSubs
        ]);
    }




}