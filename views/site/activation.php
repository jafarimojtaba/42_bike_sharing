<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ActivationCode $model */
/** @var ActiveForm $form */
?>
<div class="site-activation">
    <h4>Please enter an email address from 42 Wolfsburg to recieve the activation code!</h4>
    <h4 style="color: orange">You can use this code to register at bike sharing system!</h4>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'intraname') ?>
    <?= $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Request the Active Code!', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-activation -->
