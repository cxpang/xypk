<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Starcomment;

/**
 * StarcommentSearch represents the model behind the search form about `common\models\Starcomment`.
 */
class StarcommentSearch extends Starcomment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['starcommentid', 'uid', 'starid', 'createtime', 'updatetime'], 'integer'],
            [['starcommenttext'], 'safe'],
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
        $query = Starcomment::find();

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
            'starcommentid' => $this->starcommentid,
            'uid' => $this->uid,
            'starid' => $this->starid,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);

        $query->andFilterWhere(['like', 'starcommenttext', $this->starcommenttext]);

        return $dataProvider;
    }
}
