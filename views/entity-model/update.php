<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yeesoft\eav\models\EavEntityModel */

$this->title = Yii::t('yee', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/eav', 'EAV'), 'url' => ['/eav/default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/eav', 'Entity Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="eav-entity-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>