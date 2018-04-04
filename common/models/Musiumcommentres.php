<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "musiumcommentres".
 *
 * @property integer $musiumcommentresid
 * @property string $musiumcommentrestext
 * @property integer $uid
 * @property integer $musiumcommentid
 * @property integer $createtime
 * @property integer $musiumid
 */
class Musiumcommentres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'musiumcommentres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['musiumcommentrestext', 'uid', 'musiumcommentid', 'createtime', 'musiumid'], 'required'],
            [['uid', 'musiumcommentid', 'createtime', 'musiumid'], 'integer'],
            [['musiumcommentrestext'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'musiumcommentresid' => 'Musiumcommentresid',
            'musiumcommentrestext' => 'Musiumcommentrestext',
            'uid' => 'Uid',
            'musiumcommentid' => 'Musiumcommentid',
            'createtime' => 'Createtime',
            'musiumid' => 'Musiumid',
        ];
    }
}
