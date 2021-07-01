<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "drive_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Auto[] $autos
 */
class DriveType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drive_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Autos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutos()
    {
        return $this->hasMany(Auto::className(), ['drive_type_id' => 'id']);
    }

    public static function getDriveTypeListList()
    {
        return ArrayHelper::map(DriveType::find()->all(), 'id', 'name');
    }
}
