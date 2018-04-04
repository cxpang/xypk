<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Competcomment;

/**
 * CompetcommentSearch represents the model behind the search form about `common\models\Competcomment`.
 */
class CompetcommentSearch extends Competcomment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['competcommentid', 'uid', 'competid', 'createtime', 'updatetime'], 'integer'],
            [['competcommenttext'], 'safe'],
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
        $query = Competcomment::find();

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
            'competcommentid' => $this->competcommentid,
            'uid' => $this->uid,
            'competid' => $this->competid,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);

        $query->andFilterWhere(['like', 'competcommenttext', $this->competcommenttext]);

        return $dataProvider;
    }
}
