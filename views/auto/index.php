<?php

use app\models\Brand;
use app\models\DriveType;
use app\models\Engine;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $brandId */
/* @var $modelId */
/* @var $modelList */
/* @var $engineId */
/* @var $driveTypeId */
/* @var $title */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="auto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?= Html::dropDownList('brand', $brandId, Brand::getBrandList(), ['prompt' => 'Бренд', 'id' => 'brand']) ?>
        <?= Html::dropDownList('model', $modelId, $modelList, ['prompt' => 'Модель', 'id' => 'model']) ?>
        <?= Html::dropDownList('engine', $engineId, Engine::getEngineList(), ['prompt' => 'Двигатель', 'id' => 'engine']) ?>
        <?= Html::dropDownList('drive_type', $driveTypeId, DriveType::getDriveTypeListList(), ['prompt' => 'Привод', 'id' => 'drive-type']) ?>
        <br>
    </div>

    <div id="grid-content">
        <?= $this->render('_grid', [
            'dataProvider' => $dataProvider,
        ]) ?>
    </div>

</div>

<script>
    window.onload = function () {
        $("#brand").on("change", function () {
            let brandValue = $("#brand").val();
            if (brandValue == 0) {
                brandName = "";
            } else {
                brandName = $("#brand option:selected").text();
            }
            window.location = "/auto/" + brandName;
        })

        $("#model").on("change", function () {
            let modelValue = $("#model").val();
            let brandName = $("#brand option:selected").text();
            if (modelValue == 0) {
                window.location = "/auto/" + brandName
            } else {
                modelName = $("#model option:selected").text();
                window.location = "/auto/" + brandName + "/" + modelName;
            }
        })

        $("#engine").on("change", function () {
            getMoreInfo();
        })

        $("#drive-type").on("change", function () {
            getMoreInfo();
        })

        function getMoreInfo() {
            let brandName = $("#brand").val() != '' ? $("#brand option:selected").text() : null;
            let modelName = $("#model").val() != '' ? $("#model option:selected").text() : null;
            let engineName = $("#engine").val() != '' ? $("#engine option:selected").text() : null;
            let driveTypeName = $("#drive-type").val() != '' ? $("#drive-type option:selected").text() : null;
            $.ajax({
                url: "/auto",
                data: {
                    brandName: brandName,
                    modelName: modelName,
                    engineName: engineName,
                    driveTypeName: driveTypeName
                }
            }).done(function (data) {
                $("#grid-content").html(data);
            }).fail(function (data) {
                console.log(data);
            });
        }
    }
</script>