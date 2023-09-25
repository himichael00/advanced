<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Video $model */

$this->title = 'Create Video';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex flex-column justify-content-center align-items-center">
        <br>

        <div class="upload-icon">
            <i class="fa-solid fa-upload"></i>
        </div>

        <br>

        <p>
            drag your video here
        </p>

        <p class="text-muted">
            your video will be private until you publish it
        </p>

        <?php $form = \yii\bootstrap5\ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
        ]) ?>

        <?php echo $form->errorSummary($model) ?>

        <div class="btncenter">
            <button class="btn btn-primary btn-file">
                select file
                <input type="file" id="videoFile" name="video">
            </button>
        </div>
        
        <?php \yii\bootstrap5\ActiveForm::end() ?>
    </div>

</div>
