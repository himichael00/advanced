<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\Video $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <a class="updateButton" href="<?=Url::to(['video/update', 'video_id' => $model->video_id], ['class' => 'btn btn-primary']); ?>">Update</a>
        <?= Html::a('Delete', ['delete', 'video_id' => $model->video_id], [
            'class' => 'deleteButton',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         
    </p>

    <?php
            Modal::begin([
                'id' => 'modal',
                'size' => 'modal-lg',
            ]);

            echo "<div id='modalContent'>";

            echo "</div>";

            Modal::end();
        ?>

    <?php Pjax::begin(['id'=>'videoDetail']); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'video_id',
            'title',
            'description:ntext',
            'tags',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->getStatusLabel()[$model->status];
                }
                // 'value' => $model->status ? 'published' : 'unlisted'
            ],
            [
                'attribute' => 'has_thumbnail',
                'value' => $model->has_thumbnail ? 'Yes' : 'No'
                // 'value' => $model->status ? 'published' : 'unlisted'
            ],
            'video_name',
            'created_at',
            'updated_at',
            'created_by',
        ],
    ]) ?>
    <?php Pjax::end(); ?>

</div>

<script>

$(function(){
    // changed id to class
    $('.updateButton').on('click', function (){
        $.get($(this).attr('href'), function(data) {
          $('#modal').modal('show').find('#modalContent').html(data)
       });
       return false;
    });
}); 

</script>