<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Video $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

    <div class="row">
        <div class="col-sm-9">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group">
        <label><?php echo $model->getAttributeLabel('thumbnail') ?></label>
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                <label class="input-group-text" for="thumbnail">Browse</label>
            </div>
        </div>
        

        <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-2">
            
            <div class="embed-responsive embed-responsive-16by9 mb-3">
                <video width="400" class="embed-responsive-item" 
                poster="<?php echo $model->getImageLink() ?>"
                src="<?php echo $model->getVideoLink() ?>" controls></video>
            </div>

            <div class="mb-3">
                <div class="text-muted">Video Link</div>
                <a href="<?php echo $model->getVideoLink() ?>">Open Video</a>
            </div>

            <div class="mb-3">
                <div class="text-muted">Video Name</div>
                <?php echo $model->video_name ?>
            </div>
            <?= $form->field($model, 'status')->dropDownList($model->getStatusLabel()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-blue']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
