<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Bike $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="bike-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'pass_before')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass_now')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
