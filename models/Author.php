<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 *
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * Список авторов в виде массива ['author_id' => 'фио']
     * @param int $limit маскимальное количество
     * @param int $offset начальная позиция
     * @return array
     */
    public static function keyValueList($limit = 15, $offset = 0)
    {
        return self::find()
            ->select(['value' => "CONCAT_WS(' ', first_name, last_name)", 'id'])
            ->offset($offset)
            ->limit($limit)
            ->indexBy('id')
            ->column();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['author_id' => 'id']);
    }

    public function __toString()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
