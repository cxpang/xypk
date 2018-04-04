<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "competcommentres".
 *
 * @property integer $competcommentresid
 * @property string $competcommentrestext
 * @property integer $uid
 * @property integer $competcommentid
 * @property integer $createtime
 * @property integer $competid
 */
class Competcommentres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'competcommentres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['competcommentrestext', 'uid', 'competcommentid', 'createtime', 'competid'], 'required'],
            [['uid', 'competcommentid', 'createtime', 'competid'], 'integer'],
            [['competcommentrestext'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'competcommentresid' => 'Competcommentresid',
            'competcommentrestext' => 'Competcommentrestext',
            'uid' => 'Uid',
            'competcommentid' => 'Competcommentid',
            'createtime' => 'Createtime',
            'competid' => 'Competid',
        ];
    }
}
