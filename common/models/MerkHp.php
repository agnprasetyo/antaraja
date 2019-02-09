<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "merk_hp".
 *
 * @property int $id_driver
 * @property string $merk
 * @property string $type
 *
 * @property Driver $driver
 */
class MerkHp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'merk_hp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merk', 'type'], 'required'],
            [['id_driver'], 'integer'],
            [['merk', 'type'], 'string', 'max' => 20],
            [['id_driver'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['id_driver' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_driver' => 'Id Driver',
            'merk' => 'Merk',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'id_driver']);
    }
}
