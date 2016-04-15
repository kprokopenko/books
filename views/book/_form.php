<?php

use app\models\Author;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php if ($model->preview) {?>
        <?= Html::img($model->getPreviewUrl()) ?>
    <?php } ?>

    <?= $form->field($model, 'previewFile')->fileInput() ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'dateFormat' => $model::JS_DATE_FORMAT,
        'language' => 'ru',
        'clientOptions' => [
            'maxDate' => 0,
        ],
    ]) ?>

    <?= $form->field($model, 'author_id')->dropDownList(Author::keyValueList(), ['prompt' => 'Выберите автора']) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
