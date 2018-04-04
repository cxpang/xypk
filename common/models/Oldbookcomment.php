<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oldbookcomment".
 *
 * @property integer $oldbookcommentid
 * @property string $oldbookcommenttext
 * @property integer $uid
 * @property integer $oldbookid
 * @property integer $createtime
 * @property integer $updatetime
 *
 * @property Oldbook $oldbook
 * @property XUser $u
 */
class Oldbookcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oldbookcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldbookcommenttext', 'uid', 'oldbookid', 'createtime', 'updatetime'], 'required'],
            [['uid', 'oldbookid', 'createtime', 'updatetime'], 'integer'],
            [['oldbookcommenttext'], 'string', 'max' => 255],
            [['oldbookid'], 'exist', 'skipOnError' => true, 'targetClass' => Oldbook::className(), 'targetAttribute' => ['oldbookid' => 'oldbookid']],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oldbookcommentid' => '旧书市场评论id',
            'oldbookcommenttext' => '旧书市场评论内容',
            'uid' => '评论人id',
            'oldbookid' => '旧书市场id',
            'createtime' => '创建时间',
            'updatetime' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOldbook()
    {
        return $this->hasOne(Oldbook::className(), ['oldbookid' => 'oldbookid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(XUser::className(), ['id' => 'uid']);
    }
}
