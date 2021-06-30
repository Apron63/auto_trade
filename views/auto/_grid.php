<?php

use app\models\Brand;
use app\models\DriveType;
use app\models\Engine;
use app\models\Model;
use yii\grid\GridView;

/* @var $dataProvider yii\data\ActiveDataProvider */

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [

        [
            'attribute' => 'id',
            'filter' => '',
        ],
        [
            'attribute' => 'brand_id',
            'value' => 'brand.name',
            'filter' => Brand::getBrandList(),
        ],
        [
            'attribute' => 'model_id',
            'value' => 'model.name',
            'filter' => Model::getModelList(),
        ],
        [
            'attribute' => 'engine_id',
            'value' => 'engine.name',
            'filter' => Engine::getEngineList(),
        ],
        [
            'attribute' => 'drive_type_id',
            'value' => 'driveType.name',
            'filter' => DriveType::getDriveTypeListList(),
        ],
    ],
]);
