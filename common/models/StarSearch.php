<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Star;

/**
 * StarSearch represents the model behind the search form about `common\models\Star`.
 */
class StarSearch extends Star
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['starid', 'starprice', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['starname', 'starcontent', 'starimage', 'startime', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Star::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>8],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'starid' => $this->starid,
            'starprice' => $this->starprice,
            'uid' => $this->uid,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);

        $query->andFilterWhere(['like', 'starname', $this->starname])
            ->andFilterWhere(['like', 'starcontent', $this->starcontent])
            ->andFilterWhere(['like', 'starimage', $this->starimage])
            ->andFilterWhere(['like', 'startime', $this->startime])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
