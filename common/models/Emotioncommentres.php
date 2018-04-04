<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emotioncommentres".
 *
 * @property integer $emotioncommentresid
 * @property string $emotioncommentrestext
 * @property integer $uid
 * @property integer $emotioncommentid
 * @property integer $createtime
 * @property integer $emotionid
 */
class Emotioncommentres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emotioncommentres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emotioncommentrestext', 'uid', 'emotioncommentid', 'createtime', 'emotionid'], 'required'],
            [['uid', 'emotioncommentid', 'createtime', 'emotionid'], 'integer'],
            [['emotioncommentrestext'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emotioncommentresid' => 'Emotioncommentresid',
            'emotioncommentrestext' => 'Emotioncommentrestext',
            'uid' => 'Uid',
            'emotioncommentid' => 'Emotioncommentid',
            'createtime' => 'Createtime',
            'emotionid' => 'Emotionid',
        ];
    }
}
