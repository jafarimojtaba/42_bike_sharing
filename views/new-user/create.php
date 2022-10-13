<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NewUser $model */

$this->title = 'Create New User';
$this->params['breadcrumbs'][] = ['label' => 'New Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
