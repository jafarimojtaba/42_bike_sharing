<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Borrowedbike $model */
/** @var ActiveForm $form */
?>
<div class="site-available">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'bike_id') ?>
        <?= $form->field($model, 'date_borrowed') ?>
        <?= $form->field($model, 'date_returned') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-available -->
