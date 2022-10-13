<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        It's a bike sharing system, developed for the puprpose of transparency of bikes shared at 42 wolfsburg!
        It was developed during a Hackaton hold by student councils at 42 Wolfsburg.
        student Counsicl memebr of that time are as follow:
        <ul>
        <li><a href="https://www.linkedin.com/in/valentinsimeonovblockchaindeveloper/" target="_blank">Valentin Simeonov</a></li>
        <li><a href="https://www.linkedin.com/in/kristiyana-milcheva-9a2a84240/" target="_blank">Kristiyana (Кристияна Милчева) Milcheva</a></li>
        <li><a href="#" target="_blank">Karla Heinz</a></li>
    </ul>
    </p>
    <p>
        And it is developed by <a href="https://www.linkedin.com/in/mojtabaj/" target="_blank">Mojtaba Jafari</a>, a student from 42 wolfsburg in 2022.
    </p>

    <!-- <code><?= __FILE__ ?></code> -->
</div>
