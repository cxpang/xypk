<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property integer $examid
 * @property string $examname
 * @property string $examcontent
 * @property string $examimage
 * @property integer $uid
 * @property integer $createtime
 * @property integer $updatetime
 * @property string $status
 *
 * @property XUser $u
 * @property Examcomment[] $examcomments
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['examname', 'examcontent', 'examimage', 'uid', 'status'], 'required'],
            [['uid', 'createtime', 'updatetime'], 'integer'],
            [['examname'], 'string', 'max' => 200],
            [['examcontent'], 'string', 'max' => 255],
            [['examimage'], 'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg'],
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
            'examid' => '考试有方id',
            'examname' => '考试有方名',
            'examcontent' => '考试有方内容',
            'examimage' => '考试有方照片',
            'uid' => '发帖人',
            'createtime' => '新增时间',
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
    public function getExamcomments()
    {
        return $this->hasMany(Examcomment::className(), ['examid' => 'examid']);
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
