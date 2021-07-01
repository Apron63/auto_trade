<?php

namespace app\models;


/**
 * This is the model class for table "auto".
 *
 * @property int $id
 * @property int $brand_id
 * @property int $model_id
 * @property int $engine_id
 * @property int $drive_type_id
 *
 * @property Brand $brand
 * @property DriveType $driveType
 * @property Engine $engine
 * @property Model $model
 */
class Auto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_id', 'model_id', 'engine_id', 'drive_type_id'], 'required'],
            [['brand_id', 'model_id', 'engine_id', 'drive_type_id'], 'integer'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['drive_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DriveType::className(), 'targetAttribute' => ['drive_type_id' => 'id']],
            [['engine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engine::className(), 'targetAttribute' => ['engine_id' => 'id']],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => Model::className(), 'targetAttribute' => ['model_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand_id' => 'Бренд',
            'model_id' => 'Модель',
            'engine_id' => 'Двигатель',
            'drive_type_id' => 'Привод',
        ];
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * Gets query for [[DriveType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriveType()
    {
        return $this->hasOne(DriveType::className(), ['id' => 'drive_type_id']);
    }

    /**
     * Gets query for [[Engine]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEngine()
    {
        return $this->hasOne(Engine::className(), ['id' => 'engine_id']);
    }

    /**
     * Gets query for [[Model]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'model_id']);
    }
}
