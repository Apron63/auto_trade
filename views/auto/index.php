<?php

use app\models\Brand;
use app\models\DriveType;
use app\models\Engine;
use app\models\Model;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $brandId */
/* @var $modelId */
/* @var $engineId */
/* @var $driveTypeId */

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--    --><?php //Pjax::begin(); ?>


    <div class="row">
        <?= ''//$this->render('_search', ['model' => $searchModel]);  ?>
        <?= Html::dropDownList('brand', $brandId, Brand::getBrandList(), ['prompt' => 'Бренд', 'id' => 'brand']) ?>
        <?= Html::dropDownList('model', $modelId, Model::getModelList(), ['prompt' => 'Модель']) ?>
        <?= Html::dropDownList('engine', $engineId, Engine::getEngineList(), ['prompt' => 'Двигатель']) ?>
        <?= Html::dropDownList('drive_type', $driveTypeId, DriveType::getDriveTypeListList(), ['prompt' => 'Привод']) ?>
        <br>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

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

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <script>
        window.onload = function () {
            $("#brand").on("change", function () {
                let brandValue = $("#brand").val();
                console.log(brandValue);
                if (brandValue == 0) {
                    brandName = "";
                } else {
                    brandName = $("#brand option:selected").text();
                }
                console.log(brandName);
                window.location = "/auto/" + brandName;
            })
        }
    </script>

    <!--    --><?php //Pjax::end(); ?>

</div>
