<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "travalcommentres".
 *
 * @property integer $travalcommentresid
 * @property string $travalcommentrestext
 * @property integer $uid
 * @property integer $travalcommentid
 * @property integer $createtime
 * @property integer $travalid
 */
class Travalcommentres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'travalcommentres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['travalcommentrestext', 'uid', 'travalcommentid', 'createtime','travalid'], 'required'],
            [['uid', 'travalcommentid', 'createtime'], 'integer'],
            [['travalcommentrestext'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'travalcommentresid' => 'Travalcommentresid',
            'travalcommentrestext' => 'Travalcommentrestext',
            'uid' => 'Uid',
            'travalcommentid' => 'Travalcommentid',
            'createtime' => 'Createtime',
            'travalid'=>'Travalid'
        ];
    }
}
