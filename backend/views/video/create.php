<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

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
            'options' => ['enctype' => 'multipart/form-data', "class" => "formUpload"],
        ]); ?>

        <?php echo $form->errorSummary($model) ?>

        <div class="btncenter">
            <button class="btn btn-primary btn-file">
                select file
                <input type="file" id="videoFile" name="video">
            </button>
        </div>

        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <?php \yii\bootstrap5\ActiveForm::end() ?>
    </div>

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
                    console.log(video_id);
                    // window.location.href = videoid;
                },
                error: function() { 
                    alert("ajax error response type "+type);
                }
            })
        })
    })</script>
</div>
