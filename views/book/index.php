<?php

use app\assets\BookIndexAsset;
use app\models\Book;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

BookIndexAsset::register($this);
?>

<?php Modal::begin([
    'id' => 'preview-modal',
    'header' => '<h2>Превью</h2>',
    'clientEvents' => [
        'shown' => 'previewShowEvent',
    ],
]);

echo Html::img('');


Modal::end();
?>

<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'label' => 'Превью',
                'content' => function (Book $model) {
                    return Html::img($model->getPreviewUrl(), [
                        'class' => 'preview-button',

                    ]);
                },
            ],
            'author',
            [
                'attribute' => 'date',
                'format' => ['date', 'd MMMM YYYY']
            ],
            'date_create:relativeTime',
            
            [
                'header' => 'Кнопки действий',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
</div>


