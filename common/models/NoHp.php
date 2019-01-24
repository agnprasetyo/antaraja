<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "no_hp".
 *
 * @property int $id_user
 * @property string $nomer
 * @property string $type
 *
 * @property Driver $user
 */
class NoHp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'no_hp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'nomer', 'type'], 'required'],
            [['id_user', 'nomer'], 'integer'],
            [['type'], 'string', 'max' => 30],
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
            'nomer' => 'Nomer',
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
