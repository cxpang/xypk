<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oldbookcommentres".
 *
 * @property integer $oldbookcommentresid
 * @property string $oldbookcommentrestext
 * @property integer $uid
 * @property integer $oldbookcommentid
 * @property integer $createtime
 * @property integer $oldbookid
 */
class Oldbookcommentres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oldbookcommentres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldbookcommentrestext', 'uid', 'oldbookcommentid', 'createtime', 'oldbookid'], 'required'],
            [['uid', 'oldbookcommentid', 'createtime', 'oldbookid'], 'integer'],
            [['oldbookcommentrestext'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oldbookcommentresid' => 'Oldbookcommentresid',
            'oldbookcommentrestext' => 'Oldbookcommentrestext',
            'uid' => 'Uid',
            'oldbookcommentid' => 'Oldbookcommentid',
            'createtime' => 'Createtime',
            'oldbookid' => 'Oldbookid',
        ];
    }
}
