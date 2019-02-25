<?php

use backend\themes\dasha\widgets\yii2\ActiveForm;
use yii\helpers\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Page
 */

?>

<?php $form = ActiveForm::begin([
    'id' => 'ajax-form',
    'enableClientValidation' => false,
    'enableAjaxValidation' => false,
]) ?>

<?php echo $form->field($model, 'min')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'hour')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'day')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'month')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'weekDay')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'command')->textInput(['maxlength' => true]) ?>

<?php if (!isset($is_ajax)) : ?>
<div class="form-group">
    <?php echo Html::submitButton(Yii::t('messages', 'Save'), ['class' => 'btn btn-success']) ?>
</div>
<?php endif ?>

<?php ActiveForm::end() ?>
