<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Oldbook;

/**
 * OldbookSearch represents the model behind the search form about `common\models\Oldbook`.
 */
class OldbookSearch extends Oldbook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldbookid', 'oldbookprice', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['oldbookname', 'oldbookintro', 'oldbookimage', 'status'], 'safe'],
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
        $query = Oldbook::find();

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
            'oldbookid' => $this->oldbookid,
            'oldbookprice' => $this->oldbookprice,
            'uid' => $this->uid,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);

        $query->andFilterWhere(['like', 'oldbookname', $this->oldbookname])
            ->andFilterWhere(['like', 'oldbookintro', $this->oldbookintro])
            ->andFilterWhere(['like', 'oldbookimage', $this->oldbookimage])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
