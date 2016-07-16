<?php

namespace common\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class CreateDocument extends Model
{
    /**
     * @var $file UploadedFile
     */
    public $file;
    public $documentCategory;
    public $department;
    public $workflow;
    public $title;
    public $revisionNumber;
    public $referenceNumber;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }

}