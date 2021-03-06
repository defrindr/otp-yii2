<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\UserSearch $searchModel
 */

$this->title = 'Pengguna';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?=Html::a('<i class="fa fa-plus"></i> Tambah', ['create'], ['class' => 'btn btn-success'])?>
</p>

<div class="row">
    <div class="col-md-12">

        <div class="card m-b-30">
            <div class="card-body">

                <?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']])?>

                <?=GridView::widget([
                    'layout' => '{summary}{pager}{items}{pager}',
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'class' => app\components\annex\LinkPager::className(),
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last'],
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
                    'headerRowOptions' => ['class' => 'x'],
                    'columns' => [
                        \app\components\ActionButton::getButtons(),
                        'username',
                        //'password',
                        'name',
                        // generated by schmunk42\giiant\generators\crud\providers\RelationProvider::columnFormat
                        [
                            'class' => yii\grid\DataColumn::className(),
                            'attribute' => 'role_id',
                            'value' => function ($model) {
                                if ($rel = $model->getRole()->one()) {
                                    return Html::a($rel->name, ['role/view', 'id' => $rel->id], ['data-pjax' => 0]);
                                } else {
                                    return '';
                                }
                            },
                            'format' => 'raw',
                        ],
                    ],
                ]);?>
                <?php \yii\widgets\Pjax::end()?>
            </div>
        </div>

    </div>
</div>