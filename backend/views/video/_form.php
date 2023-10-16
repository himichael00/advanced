<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;



/** @var yii\web\View $this */
/** @var common\models\Video $model */
/** @var yii\bootstrap5\ActiveForm $form */

\backend\assets\TagsInputAsset::register($this);
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', "class" => "formUpload"]
        ]); ?>

    <div class="row">
        <div class="col-sm-9">

        <?php echo $form->errorSummary($model) ?>

        <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group">
        <label><?php echo $model->getAttributeLabel('thumbnail') ?></label>
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                <label class="input-group-text" for="thumbnail">Browse</label>
            </div>
        </div>
        

        <?= $form->field($model, 'tags', [
            'inputOptions' => ['data-role' => 'tagsinput']
        ])->textInput(['maxlength' => true]) ?>

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


    <br>

    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
    <?php ActiveForm::end(); ?>

    <script>
    var videoid = '<?= $model->video_id; ?>';
    $(document).ready(function(){
        var progressBar = $(".progress");
        progressBar.hide();

        $(".formUpload").on("submit", function(e){
            e.preventDefault();
            progressBar.show();
            $.ajax({
                xhr:function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress",function(evt){
                        console.log("evt", evt)
                        var sucesspercentage = Math.floor(((evt.loaded/evt.total)*100));
                        $(".progress-bar").width(sucesspercentage + "%");
                        $(".progress-bar").html(sucesspercentage + "%");
                    })
                    return xhr;
                },
                type:"POST",
                url: "<?= Url::to() ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $(".progress-bar").width("0%");
                },
                success: function(){
                    // console.log(video_id);
                    window.location.href = videoid;
                },
                error: function() { 
                    alert("ajax error response type "+type);
                }
            })
        })
    })</script>

</div>


