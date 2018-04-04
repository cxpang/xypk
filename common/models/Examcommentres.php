<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "examcommentres".
 *
 * @property integer $examcommentresid
 * @property string $examcommentrestext
 * @property integer $uid
 * @property integer $examcommentid
 * @property integer $createtime
 * @property integer $examid
 */
class Examcommentres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'examcommentres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['examcommentrestext', 'uid', 'examcommentid', 'createtime', 'examid'], 'required'],
            [['uid', 'examcommentid', 'createtime', 'examid'], 'integer'],
            [['examcommentrestext'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'examcommentresid' => 'Examcommentresid',
            'examcommentrestext' => 'Examcommentrestext',
            'uid' => 'Uid',
            'examcommentid' => 'Examcommentid',
            'createtime' => 'Createtime',
            'examid' => 'Examid',
        ];
    }
}
