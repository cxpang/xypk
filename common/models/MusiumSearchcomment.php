<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Musiumcomment;

/**
 * MusiumSearchcomment represents the model behind the search form about `common\models\Musiumcomment`.
 */
class MusiumSearchcomment extends Musiumcomment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['musiumcommentid', 'uid', 'musiumid', 'createtime', 'updatetime'], 'integer'],
            [['musiumcommenttext'], 'safe'],
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
        $query = Musiumcomment::find();

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
            'musiumcommentid' => $this->musiumcommentid,
            'uid' => $this->uid,
            'musiumid' => $this->musiumid,
            'createtime' => $this->createtime,
            'updatetime' => $this->updatetime,
        ]);

        $query->andFilterWhere(['like', 'musiumcommenttext', $this->musiumcommenttext]);

        return $dataProvider;
    }
}
