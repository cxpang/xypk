<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "compet".
 *
 * @property integer $competid
 * @property string $competname
 * @property string $competcontent
 * @property string $compettime
 * @property string $competimage
 * @property integer $uid
 * @property integer $createtime
 * @property integer $updatetime
 * @property string $status
 *
 * @property XUser $u
 * @property Competcomment[] $competcomments
 */
class Compet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'compet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['competname', 'competcontent', 'compettime', 'competimage', 'uid','status'], 'required'],
            [['uid', 'createtime', 'updatetime'], 'integer'],
            [['competname'], 'string', 'max' => 200],
            [['competcontent'], 'string', 'max' => 255],
            [['compettime'], 'string', 'max' => 20],
            [['competimage'], 'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg'],
            [['status'], 'string', 'max' => 10],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'competid' => '竞技空间id',
            'competname' => '竞技空间名',
            'competcontent' => '竞技空间内容',
            'compettime' => '竞技时间',
            'competimage' => '竞技照片',
            'uid' => '发布人id',
            'createtime' => '发表时间',
            'updatetime' => '修改时间',
            'status' => '帖子状态',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(XUser::className(), ['id' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetcomments()
    {
        return $this->hasMany(Competcomment::className(), ['competid' => 'competid']);
    }
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->createtime=time();
                $this->updatetime=time();
            }
            else{
                $this->updatetime=time();
            }
            return true;
        }
        else{
            return false;
        }
    }
}
