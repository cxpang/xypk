<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/10
 * Time: 16:33
 */

namespace common\services;
use common\models\Compet;
use common\models\Competcomment;
use common\models\Competcommentres;

class DelcompetService
{
    public function delcompet($competid){

        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            Competcommentres::deleteAll(['competid'=>$competid]);
            Competcomment::deleteAll(['competid'=>$competid]);
            Compet::deleteAll(['competid'=>$competid]);
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){

            $translation->rollBack();
            return $e->getMessage();
        }

    }

}