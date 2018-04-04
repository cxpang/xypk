<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "starcommentres".
 *
 * @property integer $starcommentresid
 * @property string $starcommentrestext
 * @property integer $uid
 * @property integer $starcommentid
 * @property integer $createtime
 * @property integer $starid
 */
class Starcommentres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'starcommentres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['starcommentrestext', 'uid', 'starcommentid', 'createtime', 'starid'], 'required'],
            [['uid', 'starcommentid', 'createtime', 'starid'], 'integer'],
            [['starcommentrestext'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'starcommentresid' => 'Starcommentresid',
            'starcommentrestext' => 'Starcommentrestext',
            'uid' => 'Uid',
            'starcommentid' => 'Starcommentid',
            'createtime' => 'Createtime',
            'starid' => 'Starid',
        ];
    }
}
