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
}
