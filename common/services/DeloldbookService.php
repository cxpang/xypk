<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/10
 * Time: 16:33
 */

namespace common\services;
use common\models\Oldbook;
use common\models\Oldbookcomment;
use common\models\Oldbookcommentres;

class DeloldbookService
{
    public function deloldbook($oldbookid){

        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            Oldbookcommentres::deleteAll(['oldbookid'=>$oldbookid]);
            Oldbookcomment::deleteAll(['oldbookid'=>$oldbookid]);
            Oldbook::deleteAll(['oldbookid'=>$oldbookid]);
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){

            $translation->rollBack();
            return $e->getMessage();
        }

    }

}