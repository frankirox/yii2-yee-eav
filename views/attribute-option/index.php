<?php

use yeesoft\eav\models\EavAttribute;
use yeesoft\eav\models\EavAttributeOption;
use yeesoft\grid\GridView;
use yeesoft\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EavAttributeOptionSearch */
/* @var $dataProvider yeesoft\data\ActiveDataProvider */

$this->title = Yii::t('yee/eav', 'Attribute Options');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/eav', 'EAV'), 'url' => ['/eav/default/index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['description'] = 'YeeCMS 0.2.0';
$this->params['header-content'] = Html::a(Yii::t('yee', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary']);
?>
<div class="box box-primary">
    <div class="box-body">
        <?php $pjax = Pjax::begin() ?>

        <?=
        GridView::widget([
            'pjaxId' => $pjax->id,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'quickFilters' => false,
            'columns' => [
                ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px'], 'displayFilter' => false],
                [
                    'attribute' => 'id',
                    'options' => ['style' => 'width:40px'],
                    'filterOptions' => ['colspan' => 2],
                ],
                [
                    'class' => 'yeesoft\grid\columns\TitleActionColumn',
                    'attribute' => 'value',
                    'buttonsTemplate' => '{update} {delete}',
                    'title' => function (EavAttributeOption $model) {
                        return Html::a($model->value, ['update', 'id' => $model->id], ['data-pjax' => 0]);
                    },
                ],
                [
                    'attribute' => 'attribute_id',
                    'value' => function (EavAttributeOption $model) {
                        return "{$model->attribute->id} - {$model->attribute->name} - {$model->attribute->label}";
                    },
                    'filter' => ArrayHelper::merge(['' => Yii::t('yee', 'Not Selected')], EavAttribute::getEavAttributes()),
                    'options' => ['style' => 'width:30%']
                ],
            ],
        ]);
        ?>

        <?php Pjax::end() ?>
    </div>
</div>
