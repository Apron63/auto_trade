<?php

namespace app\controllers;

use app\models\Brand;
use app\models\DriveType;
use app\models\Engine;
use app\models\Model;
use Yii;
use app\models\Auto;
use app\models\AutoSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AutoController implements the CRUD actions for Auto model.
 */
class AutoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Auto models.
     * @param null $brandName
     * @param null $modelName
     * @param null $engineName
     * @param null $driveTypeName
     * @return mixed
     */
    public function actionIndex($brandName = null, $modelName = null, $engineName = null, $driveTypeName = null)
    {
        $searchModel = new AutoSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $brand = Brand::findOne(['name' => $brandName]);
        $brandId = $brand ? $brand->id : null;
        $modelList = ArrayHelper::map(Model::find()->where(['brand_id' => $brandId])->all(), 'id', 'name');
        $model = Model::findOne(['name' => $modelName]);
        $modelId = $model ? $model->id : null;

        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('_grid', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'brandId' => $brandId,
                'modelId' => $modelId,
                'modelList' => $modelList,
                'engineId' => $engineName ? Engine::findOne(['name' => $engineName]) : null,
                'driveTypeId' => $driveTypeName ? DriveType::findOne(['name' => $driveTypeName]) : null,
            ]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'brandId' => $brandId,
            'modelId' => $modelId,
            'modelList' => $modelList,
            'engineId' => $engineName ? Engine::findOne(['name' => $engineName]) : null,
            'driveTypeId' => $driveTypeName ? DriveType::findOne(['name' => $driveTypeName]) : null,
            'title' => $this->getTitle($modelName, $brandName),
        ]);
    }

    /**
     * @param null $modelName
     * @param null $brandName
     * @return string
     */
    private function getTitle($modelName = null, $brandName = null)
    {
        return "Продажа новых автомобилей {$brandName} {$modelName} в Санкт-Петербурге";
    }
}
