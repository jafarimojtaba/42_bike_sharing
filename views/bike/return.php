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

$this->title = '';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bike-return">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4 >You have already booked a bike!</h4>
    <h4 style="color: orange">Before Clicking on Return Button</h4>
    <p>Please, Manually Change the Code of the lock to the <span style="font-weight: bold; color:#0b5ed7">Next Code</span></p>
    <p>If you have changed the code, now you can click on return button!</p>
    <?php Pjax::begin(); ?>

    <?php
    if ($role != "guest" && $role != null) {
        echo
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn',],

                'id',
//            'pass_before',
                'pass_now',
                'pass_next',
//                'available_status',
                [
                    'class' => ActionColumn::className(),
                    'template' => '{return}',
                    'buttons' => [
                        'return' => function ($action, Bike $model, $key) {
                             return Html::a('<b class="btn btn-success">Return</b>', [$action]);
                        },
                    ],
//                    'urlCreator' => function ($action, Bike $model, $key, $index, $column) {
//                        return Url::toRoute([$action, 'id' => $model->id]);
//                    }
                ],
            ],
        ]);
    }
    else
    {
        echo
        Html::a('Login', ['../site/login']);

    }
    ?>


    <?php Pjax::end(); ?>

</div>
