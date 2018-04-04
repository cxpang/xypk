<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Roomcontent;

/**
 * RoomcontentSearch represents the model behind the search form about `common\models\Roomcontent`.
 */
class RoomcontentSearch extends Roomcontent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roomcontentid', 'uid', 'roomid'], 'integer'],
            [['contenttext', 'createtime'], 'safe'],
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
        $query = Roomcontent::find();

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
            'roomcontentid' => $this->roomcontentid,
            'uid' => $this->uid,
            'roomid' => $this->roomid,
        ]);

        $query->andFilterWhere(['like', 'contenttext', $this->contenttext])
            ->andFilterWhere(['like', 'createtime', $this->createtime]);

        return $dataProvider;
    }
}
