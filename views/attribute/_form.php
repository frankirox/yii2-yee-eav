<?php

use yeesoft\helpers\FA;
use yeesoft\helpers\Html;
use yeesoft\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yeesoft\eav\models\EavAttribute */
/* @var $form yeesoft\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['validateOnBlur' => false]) ?>

<div class="row">
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body">

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'default_value')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body">
                <div class="record-info">
                    <?php if (!$model->isNewRecord): ?>
                        <?= $form->field($model, 'id')->value() ?>
                    <?php endif; ?>

                    <?= $form->field($model, 'required')->checkbox() ?>

                    <?= $form->field($model, 'type_id')->dropDownList(yeesoft\eav\models\EavAttributeType::getAttributeTypes()) ?>

                    <?=
                    $form->field($model, 'icon')->dropDownList(FA::getIconsList(), [
                        'class' => 'clearfix form-control fa-font-family',
                        'encode' => false,
                    ])
                    ?>

                    <div class="row">
                        <?php if ($model->isNewRecord): ?>
                            <div class="col-md-6">
                                <?= Html::submitButton(Yii::t('yee', 'Create'), ['class' => 'btn btn-primary btn-block']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= Html::a(Yii::t('yee', 'Cancel'), ['index'], ['class' => 'btn btn-default btn-block']) ?>
                            </div>
                        <?php else: ?>
                            <div class="col-md-6">
                                <?= Html::submitButton(Yii::t('yee', 'Save'), ['class' => 'btn btn-primary btn-block']) ?>
                            </div>
                            <div class="col-md-6">
                                <?=
                                Html::a(Yii::t('yee', 'Delete'), ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-default btn-block',
                                    'data' => [
                                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ])
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
