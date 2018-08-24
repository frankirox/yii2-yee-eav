<?php

use yeesoft\eav\models\EavAttribute;
use yeesoft\eav\models\EavAttributeType;
use yeesoft\grid\GridView;
use yeesoft\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\eav\models\search\EavAttributeSearch */
/* @var $dataProvider yeesoft\data\ActiveDataProvider */

$this->title = Yii::t('yee/eav', 'Attributes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/eav', 'EAV'), 'url' => ['/eav/default/index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['actions'] = Html::a(Yii::t('yee', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary']);
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
                    'attribute' => 'label',
                    'buttonsTemplate' => '{update} {delete}',
                    'title' => function (EavAttribute $model) {
                        return Html::a($model->label, ['update', 'id' => $model->id], ['data-pjax' => 0]);
                    },
                ],
                'name',
                [
                    'attribute' => 'type_id',
                    'value' => function (EavAttribute $model) {
                        return $model->eavType->name;
                    },
                    'filter' => ArrayHelper::merge(['' => Yii::t('yee', 'Not Selected')], EavAttributeType::getAttributeTypes()),
                    'options' => []
                ],
                //'default_value',
                'description',
                [
                    'class' => 'yeesoft\grid\columns\StatusColumn',
                    'attribute' => 'required',
                    'options' => ['style' => 'width:60px']
                ],
            ],
        ]);
        ?>

        <?php Pjax::end() ?>
    </div>
</div>
