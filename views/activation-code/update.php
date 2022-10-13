<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ActivationCode $model */

$this->title = 'Update Activation Code: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Activation Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="activation-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
