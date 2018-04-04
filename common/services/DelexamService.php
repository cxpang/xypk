<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/10
 * Time: 16:33
 */

namespace common\services;
use common\models\Exam;
use common\models\Examcomment;
use common\models\Examcommentres;

class DelexamService
{
    public function delexam($examid){

        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            Examcommentres::deleteAll(['examid'=>$examid]);
            Examcomment::deleteAll(['examid'=>$examid]);
            Exam::deleteAll(['examid'=>$examid]);
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){

            $translation->rollBack();
            return $e->getMessage();
        }

    }

}