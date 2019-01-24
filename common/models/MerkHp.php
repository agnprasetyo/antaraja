<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "merk_hp".
 *
 * @property int $id_user
 * @property string $merk
 * @property string $type
 *
 * @property Driver $user
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
            [['id_user', 'merk', 'type'], 'required'],
            [['id_user'], 'integer'],
            [['merk', 'type'], 'string', 'max' => 20],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'merk' => 'Merk',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Driver::className(), ['id' => 'id_user']);
    }
}
