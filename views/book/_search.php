<?php

use app\models\Author;
use app\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'author_id')->dropDownList(Author::keyValueList(), ['prompt' => 'автор']) ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'date_from')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'date_to')->widget(DatePicker::className()) ?>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
