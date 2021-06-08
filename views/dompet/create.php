<?php
echo "<h1>Dompet</h1>";

use yii\widgets\ActiveForm;;
use app\models\Dompet;
use yii\jui\DatePicker;
use yii\helpers\Html;
use janisto\timepicker\TimePicker;
use kartik\money\MaskMoney;

$model = new Dompet();
?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, "date")->widget(DatePicker::className(), [
        'dateFormat' => "php:Y-m-d"
    ]) ?>
    <?= '<p>Time</p>' ?>
    <?= TimePicker::widget([
    'model' => $model,
    'attribute' => 'time',
    'mode' => 'time',
    'clientOptions'=>[
        'timeFormat' => 'HH:mm:ss',
        'showSecond' => true,
    ],
    'name' => "Time"
]) ?>
    <?= $form->field($model, "description") ?>
    <?= $form->field($model, "action")->dropDownList($model->arrayAction()) ?>
    <?= '<p>Amount</p>' ?>

    <?= MaskMoney::widget([
        'model' => $model,
        'attribute' => 'amount',
        'name' => 'amount',
        'value' => 0,
        'pluginOptions' => [
            'prefix' => 'Rp.',
            'thousands' => '.',
            'decimal' => ','
        ],
    ]); ?>
    <?= '<p></p>' ?>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>