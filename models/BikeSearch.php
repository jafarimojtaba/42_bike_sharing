<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bike;

/**
 * BikeSearch represents the model behind the search form of `app\models\Bike`.
 */
class BikeSearch extends Bike
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'available_status'], 'integer'],
            [['pass_before', 'pass_now', 'hold_by'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Bike::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'available_status' => $this->available_status,
        ]);

        $query->andFilterWhere(['like', 'pass_before', $this->pass_before])
            ->andFilterWhere(['like', 'pass_now', $this->pass_now])
        ->andFilterWhere(['like', 'hold_by', $this->hold_by]);

        return $dataProvider;
    }
}
