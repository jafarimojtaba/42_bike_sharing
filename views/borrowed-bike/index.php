<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\BorrowedbikeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Booking Logs';
?>
<div class="borrowed-bike-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
