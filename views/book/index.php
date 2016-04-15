<?php

use app\assets\BookIndexAsset;
use app\models\Book;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

BookIndexAsset::register($this);
?>

<?php Dialog::begin([
    'id' => 'preview-modal',
    'clientOptions' => [
        'modal' => true,
        'autoOpen' => false,
        'width' => 600,
        'height' => 600,
    ],
]);

echo Html::img('');

Dialog::end();
?>

<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
