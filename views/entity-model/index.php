<?php

use yeesoft\eav\models\EavEntityModel;
use yeesoft\grid\GridView;
use yeesoft\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\eav\search\EavEntityModelSearch */
/* @var $dataProvider yeesoft\data\ActiveDataProvider */

$this->title = Yii::t('yee/eav', 'Entity Models');
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
                    'attribute' => 'entity_name',
                    'buttonsTemplate' => '{update} {delete}',
                    'title' => function (EavEntityModel $model) {
                        return Html::a($model->entity_name, ['update', 'id' => $model->id], ['data-pjax' => 0]);
                    },
                ],
                [
                    'attribute' => 'entity_model',
                    'options' => ['style' => 'width:30%']
                ],
            ],
        ]);
        ?>

        <?php Pjax::end() ?>
    </div>
</div>