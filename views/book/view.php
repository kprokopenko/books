<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
