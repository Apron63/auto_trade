<?php

namespace app\controllers;

use app\models\Brand;
use app\models\Engine;
use app\models\Model;
use Yii;
use app\models\Auto;
use app\models\AutoSearch;
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

//        $urlParams = [];
//        if (!empty($brand)) {
//            $urlParams['brand'] = $brand;
//        }
//        if (!empty($model)) {
//            $urlParams['model'] = $model;
//        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'brandId' => $brandName ? Brand::findOne(['name' => $brandName]) : null,
            'modelId' => $modelName ? Model::findOne(['name' => $modelName]) : null,
            'engineId' => $engineName ? Engine::findOne(['name' => $engineName]) : null,
            'driveTypeId' => $driveTypeName ? Brand::findOne(['name' => $driveTypeName]) : null,
        ]);
    }

    /**
     * Displays a single Auto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Auto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Auto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Auto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Auto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Auto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Auto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
