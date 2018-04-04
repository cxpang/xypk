<?php
/**
 * Created by PhpStorm.
 * User: pangchenxu
 * Date: 2018/3/7
 * Time: 14:22
 */

namespace common\services;
use common\models\Emotion;
use common\models\Emotioncomment;

class DelEmotionService
{
    public function delemotion($emotionid){

        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            Travalcommentres::deleteAll(['emotionid'=>$emotionid]);
            Emotioncomment::deleteAll(['emotionid'=>$emotionid]);
            Emotion::deleteAll(['emotionid'=>$emotionid]);
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){

            $translation->rollBack();
            return $e->getMessage();
        }

    }
}