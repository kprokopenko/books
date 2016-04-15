<?php

namespace app\widgets;

use app\models\Book;

class DatePicker extends \yii\jui\DatePicker
{
    public $dateFormat = Book::JS_DATE_FORMAT;

    public $language = 'ru';

    public $clientOptions = [
        'maxDate' => 0,
    ];
}
