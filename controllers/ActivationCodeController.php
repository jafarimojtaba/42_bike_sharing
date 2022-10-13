<?php

namespace app\controllers;

use app\models\ActivationCode;
use app\models\ActivationCodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;
use yii\db\Exception;

/**
 * ActivationCodeController implements the CRUD actions for ActivationCode model.
 */
class ActivationCodeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ActivationCode models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $db = \Yii::$app->db;
        $user_id = yii::$app->session['__id'];
        if ($user_id)
            $role = $db->createCommand("SELECT role FROM new_user WHERE id=$user_id")->queryOne();
        else
            $role['role'] = "guest";
        if ($role['role'] != "admin") {
            return $this->render('sorry');
        }

        $searchModel = new ActivationCodeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActivationCode model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $db = \Yii::$app->db;
        $user_id = yii::$app->session['__id'];
        if ($user_id)
            $role = $db->createCommand("SELECT role FROM new_user WHERE id=$user_id")->queryOne();
        else
            $role['role'] = "guest";
        if ($role['role'] != "admin") {
            return $this->render('sorry');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ActivationCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $db = \Yii::$app->db;
        $user_id = yii::$app->session['__id'];
        if ($user_id)
            $role = $db->createCommand("SELECT role FROM new_user WHERE id=$user_id")->queryOne();
        else
            $role['role'] = "guest";
        if ($role['role'] != "admin") {
            return $this->render('sorry');
        }
        $model = new ActivationCode();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ActivationCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $db = \Yii::$app->db;
        $user_id = yii::$app->session['__id'];
        if ($user_id)
            $role = $db->createCommand("SELECT role FROM new_user WHERE id=$user_id")->queryOne();
        else
            $role['role'] = "guest";
        if ($role['role'] != "admin") {
            return $this->render('sorry');
        }
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ActivationCode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $db = \Yii::$app->db;
        $user_id = yii::$app->session['__id'];
        if ($user_id)
            $role = $db->createCommand("SELECT role FROM new_user WHERE id=$user_id")->queryOne();
        else
            $role['role'] = "guest";
        if ($role['role'] != "admin") {
            return $this->render('sorry');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ActivationCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ActivationCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivationCode::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
