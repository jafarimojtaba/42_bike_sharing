<?php

use app\models\Borrowedbike;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\BorrowedbikeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Booking Logs';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowedbike-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'attribute'=>'user_id',
//                'value'=>'user.username',
//            ],
            'username',
            'bike_id',
            'date_borrowed',
            [
                'attribute' => 'date_returned',
                'value' => function ($model) {
                    if ($model->date_returned == null)
                        return ("Not returned!");
                    else
                        return ($model->date_returned);
                }
            ],
//            'date_returned',

//            [
//                'class' => ActionColumn::className(),
//                'template' => '{delete}',
//                'urlCreator' => function ($action, Borrowedbike $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                 }
//            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
