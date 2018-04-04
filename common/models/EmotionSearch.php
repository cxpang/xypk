<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\emotion;

/**
 * EmotionSearch represents the model behind the search form about `common\models\emotion`.
 */
class EmotionSearch extends emotion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emotionid', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['emotionname', 'emotioncontent', 'emotionimage'], 'safe'],
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
        $query = emotion::find();

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
            'emotionid' => $this->emotionid,
            'uid' => $this->uid,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);

        $query->andFilterWhere(['like', 'emotionname', $this->emotionname])
            ->andFilterWhere(['like', 'emotioncontent', $this->emotioncontent])
            ->andFilterWhere(['like', 'emotionimage', $this->emotionimage]);

        return $dataProvider;
    }
}
