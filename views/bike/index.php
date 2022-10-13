<?php

use app\models\Bike;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\BikeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bikes';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bike-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>

        <?php
        if ($role == "admin")
            echo
            Html::a('Create Bike', ['create'], ['class' => 'btn btn-success']);
        ?>
    </p>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $student_template = '{book}';
    if ($role == "student") {
        echo
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn',],

                'id',
//            'pass_before',
//            'pass_now',
//            'hold_by',
                [
                    'attribute' => 'available_status',
                    'value' => function (Bike $model) {
                        if ($model->available_status == '1')
                            return ("Yes");
                        else
                            return ("No");
                    },
                ],

                [

                    'attribute' => 'hold_by',
                    'value' => function (Bike $model) {
                        if ($model->available_status == '1')
                            return ('Nobody');
                        else
                            return ($model->hold_by);
                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'template' => $student_template,
                    'buttons' => [
                        'book' => function ($action, Bike $model, $key) {
                            if ($model->available_status == '0')
                                return;
                            return Html::a('<b class="btn btn-success">Book</b>', [$action]);
                        },
                    ],
//                    'urlCreator' => function ($action, Bike $model, $key, $index, $column) {
//                        return Url::toRoute([$action, 'id' => $model->id]);
//                    }
                ],

            ],
        ]);
    } else if ($role == "admin") {
        echo
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn',],

                'id',
                'pass_before',
                'pass_now',
                'available_status',
                'hold_by',
                [
                    'class' => ActionColumn::className(),
                    'template' => '{view} {update} {book}',
                    'buttons' => [
                        'book' => function ($action, Bike $model, $key) {
                            if ($model->available_status == '0')
                                return;
                            return Html::a('<b class="btn btn-success">Book</b>', [$action]);
                        },
                    ],
                    'urlCreator' => function ($action, Bike $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]);
    } else {
        echo
        "<h1>To use the booking system you need to login!</h1>";
        echo
        Html::a('Login', ['../site/login']);

    }
    ?>


    <?php Pjax::end(); ?>

</div>
