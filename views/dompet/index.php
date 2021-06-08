<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;

echo "<h1>Wallet</h1>";
Pjax::begin();

?>
<?= Html::a('Create', ['/dompet/create'], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'date',
        'time',
        'description',
        'action',
        'amount'
    ],
    'pager' => [
        'class' => \yii\bootstrap4\LinkPager::class,
     ]
]) ?>
<?php
Pjax::end();
?>
