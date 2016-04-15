<?php

namespace app\components;

use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * Компонент хранения изображений в файловой системе
 */
class Files extends Component
{
    /**
     * @var string Корневая директория в ФС. Можно использовать alias
     */
    public $rootPath = '';
    /**
     * @var string Корень для URL. Можно использовать alias
     */
    public $rootUrl = '';

    /**
     * Генерация уникального имени для сохранения в ФС
     * @param null $ext
     * @return string
     */
    private function generateUniqId($ext = null)
    {
        $id = uniqid();
        if (!is_null($ext)) {
            $id .= '.' . $ext;
        }

        return $id;
    }

    /**
     * Построение пути к файлу в ФС по id
     * @param $id
     * @return string
     */
    private function path($id)
    {
        return \Yii::getAlias(FileHelper::normalizePath($this->rootPath . DIRECTORY_SEPARATOR . $id));
    }

    /**
     * Получить URL по id
     * @param $id
     * @return string
     */
    public function url($id)
    {
        return $this->rootUrl . '/' . $id;
    }

    /**
     * Сохраняет UploadFile в файловой системе
     * @param UploadedFile $file
     * @param string $old Необязательный. Если указан, то перезаписываем существующий файл
     * @return null|string При успешном сохранении возвращает id файла
     */
    public function saveUploadFile(UploadedFile $file, $old = null)
    {
        if ($old) {
            $id = $old;
        } else {
            $id = $this->generateUniqId($file->extension);
        }

        if ($file->saveAs($this->path($id))) {
            return $id;
        }

        return null;
    }

    /**
     * Удаление файла из ФС
     * @param $id
     */
    public function delete($id)
    {
        unlink($this->path($id));
    }
}
