<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "roomcontent".
 *
 * @property integer $roomcontentid
 * @property string $contenttext
 * @property integer $uid
 * @property integer $roomid
 * @property string $createtime
 */
class Roomcontent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roomcontent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contenttext', 'uid', 'roomid', 'createtime'], 'required'],
            [['uid', 'roomid'], 'integer'],
            [['contenttext'], 'string', 'max' => 255],
            [['createtime'], 'string', 'max' => 11],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
            [['roomid'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['roomid' => 'roomid']],

        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'roomcontentid' => '合租空间评论id',
            'contenttext' => '合租空间评论内容',
            'uid' => '评论人',
            'roomid' => '合租空间id',
            'createtime' => '评论时间',
        ];
    }
    public function getU()
    {
        return $this->hasOne(XUser::className(), ['id' => 'uid']);
    }
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['roomid' => 'roomid']);
    }
}
