<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Room;

/**
 * RoomSearch represents the model behind the search form about `common\models\Room`.
 */
class RoomSearch extends Room
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roomid', 'roomprice', 'uid'], 'integer'],
            [['roomname', 'roomimage', 'roomaddress', 'roomstatus', 'createtime'], 'safe'],
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
        $query = Room::find();

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
            'roomid' => $this->roomid,
            'roomprice' => $this->roomprice,
            'uid' => $this->uid,
        ]);

        $query->andFilterWhere(['like', 'roomname', $this->roomname])
            ->andFilterWhere(['like', 'roomimage', $this->roomimage])
            ->andFilterWhere(['like', 'roomaddress', $this->roomaddress])
            ->andFilterWhere(['like', 'roomstatus', $this->roomstatus])
            ->andFilterWhere(['like', 'createtime', $this->createtime]);

        return $dataProvider;
    }
}
