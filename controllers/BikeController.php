<?php

namespace app\controllers;

use yii;
use yii\db\Exception;
use yii\db\Expression;
use app\models\Bike;
use app\models\BikeSearch;
use app\models\NewUser;
use app\models\Borrowedbike;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * BikeController implements the CRUD actions for Bike model.
 */
class BikeController extends Controller
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
     * Lists all Bike models.
     *
     * @return string
     * @throws Exception
     */
    public function actionIndex()
    {
        $db = \Yii::$app->db;
        $user_id = yii::$app->session['__id'];
        $borrowed['has_booking'] = 0;
        if ($user_id) {
            $role = $db->createCommand("SELECT role FROM new_user WHERE id=$user_id")->queryOne();
            $borrowed = $db->createCommand("SELECT has_booking FROM new_user WHERE id=$user_id")->queryOne();
        } else
            $role['role'] = "guest";

        $searchModel = new BikeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($borrowed['has_booking'] != 0) {
            $model1 = $db->createCommand("SELECT bike_id FROM borrowedbike WHERE user_id=$user_id AND date_returned IS NULL")->queryOne();

            $dataProvider->query->andWhere(['id' => $model1['bike_id']]);

            return $this->render('return', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model1' => $model1['bike_id'],
                'role' => $role['role'],
//                'model' => $this->findModel($id),
            ]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'role' => $role['role'],
        ]);
    }

    /**
     * Displays a single Bike model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionBook($id)
    {
        $u_bike = $this->findModel($id);
        $user_id = yii::$app->session['__id'];
        if ($u_bike->available_status && $user_id) {
            \Yii::$app->db->createCommand()
                ->update('new_user', ['has_booking' => 1], 'id =:user_id')->bindValue(':user_id', $user_id)
                ->execute();
            $user_name = \Yii::$app->db->createCommand("SELECT username FROM new_user WHERE id=$user_id")->queryOne();

            $b_bike = new Borrowedbike();
            $b_bike->bike_id = $id;
            $b_bike->user_id = yii::$app->session['__id'];
            $b_bike->date_borrowed = date('Y-m-d h:i:s');
            $b_bike->username = $user_name['username'];
            $b_bike->save();
            $u_bike->available_status = 0;
            $u_bike->hold_by = $user_name['username'];
            $u_bike->save();
            return $this->redirect(['index']);

        } else {
            return $this->render('sorry', [
                'model' => $this->findModel($id),
            ]);
        }
//        return $this->render('success');
    }


    public function actionReturn($id)
    {
        $u_bike = $this->findModel($id);
        $user_id = yii::$app->session['__id'];
        if ($u_bike->available_status == 0 && $user_id) {
            \Yii::$app->db->createCommand()
                ->update('new_user', ['has_booking' => 0], 'id =:user_id')->bindValue(':user_id', $user_id)
                ->execute();

            $bbid = \Yii::$app->db->createCommand("SELECT id FROM borrowedbike WHERE user_id=$user_id AND date_returned IS NULL")->queryOne();
            $b_bike = Borrowedbike::findOne($bbid['id']);
            $b_bike->date_returned = date('Y-m-d h:i:s');
            $b_bike->save();
            $u_bike->available_status = 1;
            $u_bike->pass_before = $u_bike->pass_now;
            $u_bike->pass_now = $u_bike->pass_next;
            $u_bike->pass_next = (string)random_int(1111, 9999);
            $u_bike->hold_by = 'Nobody';
            $u_bike->save();
        }
        return $this->redirect(['index']);
    }

    /**
     * Creates a new Bike model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
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
            return $this->actionIndex();
        }
        $model = new Bike();

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
     * Updates an existing Bike model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
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
            return $this->actionIndex();
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
     * Deletes an existing Bike model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
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
            return $this->actionIndex();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bike model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Bike the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bike::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
