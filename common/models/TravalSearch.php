<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Traval;

/**
 * TravalSearch represents the model behind the search form about `common\models\Traval`.
 */
class TravalSearch extends Traval
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['travalid', 'travalprice', 'travaldays', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['travalname', 'travaltime', 'travalcontent', 'travalimage', 'status'], 'safe'],
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
        $query = Traval::find();

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
            'travalid' => $this->travalid,
            'travalprice' => $this->travalprice,
            'travaldays' => $this->travaldays,
            'uid' => $this->uid,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);

        $query->andFilterWhere(['like', 'travalname', $this->travalname])
            ->andFilterWhere(['like', 'travaltime', $this->travaltime])
            ->andFilterWhere(['like', 'travalcontent', $this->travalcontent])
            ->andFilterWhere(['like', 'travalimage', $this->travalimage])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
