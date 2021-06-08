<?php
echo "<h1>Dompet</h1>";

use yii\widgets\ActiveForm;;
use app\models\Dompet;
use yii\jui\DatePicker;
use yii\helpers\Html;
use janisto\timepicker\TimePicker;

$model = new Dompet();
?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, "date")->widget(DatePicker::className(), [
        'dateFormat' => "php:Y-m-d"
    ]) ?>
    <?= TimePicker::widget([
     //'language' => 'fi',
    'model' => $model,
    'attribute' => 'time',
    'mode' => 'time',
    'clientOptions'=>[
        'timeFormat' => 'HH:mm:ss',
        'showSecond' => true,
    ]
]) ?>
    <?= $form->field($model, "description") ?>
    <?= $form->field($model, "action")->dropDownList($model->arrayAction()) ?>
    <?= $form->field($model, "amount")->textInput(['type' => 'number']) ?>

    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>