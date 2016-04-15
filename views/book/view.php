<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

?>
<div class="book-view">

    <h1><?= Html::encode($model->name) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date_create:date',
            'date_update:date',
            [
                'attribute' => 'preview',
                'value' => Html::img($model->getPreviewUrl(), [
                    'class' => 'preview-button',
                ]),
                'format' => 'raw',
            ],
            'date:date',
            'author',
        ],
    ]) ?>

</div>
