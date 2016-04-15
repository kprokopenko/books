<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date_create
 * @property integer $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 *
 * @property Author $author
 */
class Book extends \yii\db\ActiveRecord
{
    const PHP_DATE_FORMAT = 'Y-m-d';
    const JS_DATE_FORMAT = 'yyyy-MM-dd';

    /**
     * @var UploadedFile
     */
    private $_previewFile;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date', 'author_id'], 'required'],
            [['author_id'], 'integer'],
            [['date'], 'date',
                'format' => 'php:' . self::PHP_DATE_FORMAT,
                'max' => time(),
                'tooBig' => 'Возможна только прошедшая дата',
            ],
            [['name'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
            ['previewFile', 'image'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'preview' => 'Превью книги',
            'previewFile' => 'Превью книги',
            'date' => 'Дата выхода книги',
            'author_id' => 'Автор',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->_previewFile instanceof UploadedFile) { //Загружаем изображение
                $this->preview = \Yii::$app->files->saveUploadFile($this->_previewFile, $this->preview);
            }

            return true;
        } else {
            return false;
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();
        \Yii::$app->files->delete($this->preview);
    }

    public function setPreviewFile()
    {
        //Неважно, что мы передаем в параметре, мы все равно берем из UploadFile
        $this->_previewFile = UploadedFile::getInstance($this, 'previewFile');
    }

    public function getPreviewFile()
    {
        return $this->_previewFile;
    }

    /**
     * Ссылка на превью книги
     * @return null
     */
    public function getPreviewUrl()
    {
        if ($this->preview) {
            return \Yii::$app->files->url($this->preview);
        }

        return null;
    }
}
