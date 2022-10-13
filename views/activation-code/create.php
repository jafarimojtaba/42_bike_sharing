<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ActivationCode $model */

$this->title = 'Create Activation Code';
$this->params['breadcrumbs'][] = ['label' => 'Activation Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activation-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
