<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Musium;

/**
 * MusiumSearch represents the model behind the search form about `common\models\Musium`.
 */
class MusiumSearch extends Musium
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['musiumid', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['musiumname', 'musiumcontent', 'musiumimage', 'status'], 'safe'],
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
        $query = Musium::find();

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
            'musiumid' => $this->musiumid,
            'uid' => $this->uid,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);

        $query->andFilterWhere(['like', 'musiumname', $this->musiumname])
            ->andFilterWhere(['like', 'musiumcontent', $this->musiumcontent])
            ->andFilterWhere(['like', 'musiumimage', $this->musiumimage])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
