<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "musiumcomment".
 *
 * @property integer $musiumcommentid
 * @property string $musiumcommenttext
 * @property integer $uid
 * @property integer $musiumid
 * @property integer $createtime
 * @property integer $updatetime
 *
 * @property Musium $musium
 * @property XUser $u
 */
class Musiumcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'musiumcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['musiumcommenttext', 'uid', 'musiumid', 'createtime', 'updatetime'], 'required'],
            [['uid', 'musiumid', 'createtime', 'updatetime'], 'integer'],
            [['musiumcommenttext'], 'string', 'max' => 255],
            [['musiumid'], 'exist', 'skipOnError' => true, 'targetClass' => Musium::className(), 'targetAttribute' => ['musiumid' => 'musiumid']],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'musiumcommentid' => '图书馆约评论id',
            'musiumcommenttext' => '图书馆约评论内容',
            'uid' => '评论人id',
            'musiumid' => '图书馆约id',
            'createtime' => '创建时间',
            'updatetime' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMusium()
    {
        return $this->hasOne(Musium::className(), ['musiumid' => 'musiumid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(XUser::className(), ['id' => 'uid']);
    }
}
