<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/10
 * Time: 16:33
 */

namespace common\services;
use common\models\Musium;
use common\models\Musiumcomment;
use common\models\Musiumcommentres;

class DelmusiumService
{
    public function delmusium($musiumid){

        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            Musiumcommentres::deleteAll(['musiumid'=>$musiumid]);
            Musiumcomment::deleteAll(['musiumid'=>$musiumid]);
            Musium::deleteAll(['musiumid'=>$musiumid]);
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){

            $translation->rollBack();
            return $e->getMessage();
        }

    }

}