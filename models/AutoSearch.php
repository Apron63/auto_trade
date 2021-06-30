<?php

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * AutoSearch represents the model behind the search form of `app\models\Auto`.
 */
class AutoSearch extends Auto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'brand_id', 'model_id', 'engine_id', 'drive_type_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function scenarios()
//    {
//        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
//    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Auto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
                'route' => '/auto'
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $brandId = null;
        if (!empty($params['brandName'])) {
            if ($brand = Brand::findOne(['name' => $params['brandName']])) {
                $brandId = $brand->id;
            } else {
                $query->where('0=1');
            }
        }

        $modelId = null;
        if (!empty($params['modelName'])) {
            if ($model = Model::findOne(['name' => $params['modelName']])) {
                $modelId = $model->id;
            } else {
                $query->where('0=1');
            }
        }

        $engineId = null;
        if (!empty($params['engineName'])) {
            if ($engine = Engine::findOne(['name' => $params['engineName']])) {
                $engineId = $engine->id;
            }
        }

        $driveTypeId = null;
        if (!empty($params['driveTypeName'])) {
            if ($driveType = DriveType::findOne(['name' => $params['driveTypeName']])) {
                $driveTypeId = $driveType->id;
            }
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'brand_id' => $brandId,
            'model_id' => $modelId,
            'engine_id' => $engineId,
            'drive_type_id' => $driveTypeId,
        ]);

        return $dataProvider;
    }
}
