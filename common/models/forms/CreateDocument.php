<?php

namespace common\models\forms;

use common\models\File;
use common\models\FileFormat;
use Yii;
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
    public $revision;

    public function rules()
    {
        return [
            [['file', 'documentCategory', 'department', 'workflow', 'title', 'referenceNumber'], 'required'],
            [['referenceNumber'], 'string'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $tempPath = Yii::getAlias('@data/uploads/') . $this->file->baseName . '.' . $this->file->extension;
            if ($this->file->saveAs($tempPath)) {
                $file = new File();
                $fileFormat = FileFormat::findOne(['extension' => $this->file->extension]);
                $file->path = $tempPath;
                $file->file_format = $fileFormat->id;
                if (!$file->save()) {
                    return false;
                }
                $path = Yii::getAlias('@data/' . $file->id . '.' . $fileFormat->extension);
                if (rename($tempPath, $path)) {
                    $file->path = $path;
                    if (!$file->save()) {
                        return false;
                    }
                    $this->revision = 1;
                    return $file->id;
                }
            }
            return false;
        }
        return false;
    }

}