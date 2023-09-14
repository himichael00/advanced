<?php

?>

<aside class="shadow">
    <?php echo \yii\bootstrap5\Nav::widget([
        'options' => [
            'class' => 'aside d-flex flex-column nav-pills'
        ],
        'items' => [
            [
                'label' => 'Dashboard',
                'url' => ['/site/index']
            ],
            [
                'label' => 'Videos',
                'url' => ['/video/index']
            ]
        ]
    ]) ?>
</aside>