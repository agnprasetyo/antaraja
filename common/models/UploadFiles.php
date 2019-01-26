<?php

namespace common\models;

/**
 *
 */
class UploadFiles extends Driver
{
    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf'],
        ];
    }

    // public function files()
    // {
    //     if ($this->validate()) {
    //         $this->data->saveAs('uploads/' . $this->data->baseName . '.' . $this->data->extension);
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
