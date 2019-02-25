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
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
]) ?>

<div class="modal-header">
    <h4 class="modal-title"><?= Yii::t('backend', 'Edit cron task') ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <?php echo $this->render('_form', [
        'model' => $model,
        'is_ajax' => true,
    ]) ?>

</div>
<div class="modal-footer">
    <?= Html::button('<i class="icon fa fa-save"></i> ' . Yii::t('backend', 'Save'),
        ['class' => 'btn btn-success save-form']) ?>
    <a href="#" class="btn btn-info" data-dismiss="modal"><i class="icon fa fa-remove"></i> <?= Yii::t('message', 'Close') ?></a>
</div>
