<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chatpoint".
 *
 * @property integer $id
 * @property integer $fromid
 * @property integer $toid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Chatpoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chatpoint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fromid', 'toid', 'created_at', 'updated_at'], 'required'],
            [['fromid', 'toid', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fromid' => 'Fromid',
            'toid' => 'Toid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
