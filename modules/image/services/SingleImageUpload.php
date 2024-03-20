<?php

namespace app\modules\image\services;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\modules\image\models\Image;

class SingleImageUpload
{
    private $model;
    private $entity_class = 'image';
    private $imageAttribute = 'image';
    private $storagePath;

    public function __construct(
        Model $model,
        string $entity_class,
        string $imageAttribute,
        string $storagePath = '/storage/'
    ) {
        $this->model = $model;
        $this->entity_class = $entity_class;
        $this->imageAttribute = $imageAttribute;

        $this->storagePath = $storagePath;
    }

    /**
     * @return boolean
     */
    public function saveImage(): bool
    {
        $imageFile = UploadedFile::getInstance($this->model, $this->imageAttribute);

        if ($imageFile && $this->save($imageFile)) {
            return true;
        }

        return false;
    }

    /**
     * @param UploadedFile $imageFile
     * @return string
     */
    private function getFileName(UploadedFile $imageFile): string
    {
        return uniqid() . '.' . $imageFile->extension;
    }

    /**
     * @param UploadedFile $imageFile
     * @return boolean
     */
    private function save(UploadedFile $imageFile): bool
    {
        $imageName = $this->getFileName($imageFile);
        $imagePath = $this->storagePath .  $imageName;
        $imageUploadPath = Yii::getAlias('@webroot') . $imagePath;
        $isUpload = $imageFile->saveAs($imageUploadPath);

        if ($isUpload) {
            $image = new Image();
            $image->entity = $this->entity_class;
            $image->entity_id = $this->model->id;
            $image->path = $imagePath;
            $image->filename = $imageName;
            $image->mime_type = $imageFile->type;
            $image->width = getimagesize($imageUploadPath)[0];
            $image->height = getimagesize($imageUploadPath)[1];
            $image->file_size = filesize($imageUploadPath);
            $image->created_at = date('Y-m-d H:i:s');

            if ($image->save()) {
                $this->model->{$this->imageAttribute} = $image->id;

                return true;
            }
        }

        return false;
    }
}
