<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "no_hp".
 *
 * @property int $id
 * @property int $id_driver
 * @property string $nomer
 * @property string $type
 *
 * @property Driver $driver
 */
class NoHp extends \yii\db\ActiveRecord
{
    const TYPE_UTAMA = 'Utama';
    const TYPE_ALTERNATIF = 'Alternatif';

    public $nomer1;
    public $nomer2;

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
            ['type', 'default', 'value' => self::TYPE_UTAMA],
            [['nomer1'], 'required'],
            [['id_driver', 'nomer1', 'nomer2'], 'integer'],
            [['nomer1', 'nomer2'], 'string', 'max' => 20],
            [['type'], 'string', 'max' => 30],
            [['id_driver'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['id_driver' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_driver' => 'Id Driver',
            'nomer1' => 'Nomor HP Utama',
            'nomer2' => 'Nomor HP Alternatif',
            'type' => 'Type HP',
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
