<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "roomcontentres".
 *
 * @property integer $roomcontentresid
 * @property string $contentrestext
 * @property integer $uid
 * @property integer $roomcontentid
 * @property string $createtime
 */
class Roomcontentres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roomcontentres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contentrestext', 'uid', 'roomcontentid', 'createtime'], 'required'],
            [['uid', 'roomcontentid'], 'integer'],
            [['contentrestext'], 'string', 'max' => 255],
            [['createtime'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'roomcontentresid' => 'Roomcontentresid',
            'contentrestext' => 'Contentrestext',
            'uid' => 'Uid',
            'roomcontentid' => 'Roomcontentid',
            'createtime' => 'Createtime',
        ];
    }
}
