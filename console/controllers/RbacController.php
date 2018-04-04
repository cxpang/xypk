<?php
namespace console\controllers;



use yii;
use yii\console\Controller;

class RbacController extends Controller{
    public function actionInit(){
        $auth=Yii::$app->authManager;
        //添加‘createRoom’权限
        $createRoom=$auth->createPermission('createRoom');
        $createRoom->description='添加合租空间';
        $auth->add($createRoom);
        //添加'updateRoom'权限
        $updateRoom=$auth->createPermission('updateRoom');
        $updateRoom->description='修改合租空间';
        $auth->add($updateRoom);

        //添加'deleteRoom'权限
        $deleteRoom=$auth->createPermission('deleteRoom');
        $deleteRoom->description='删除合租空间';
        $auth->add($deleteRoom);


        //添加‘createTraval’权限
        $createTraval=$auth->createPermission('createTraval');
        $createTraval->description='添加旅行故事';
        $auth->add($createTraval);
        //添加'updateTraval'权限
        $updateTraval=$auth->createPermission('updateTraval');
        $updateTraval->description='修改旅行故事';
        $auth->add($updateTraval);

        //添加'deleteTraval'权限
        $deleteTraval=$auth->createPermission('deleteTraval');
        $deleteTraval->description='删除旅行故事';
        $auth->add($deleteTraval);


        //添加‘createEmotion’权限
        $createEmotion=$auth->createPermission('createEmotion');
        $createEmotion->description='添加情感天地';
        $auth->add($createEmotion);
        //添加'updateEmotion'权限
        $updateEmotion=$auth->createPermission('updateEmotion');
        $updateEmotion->description='修改情感天地';
        $auth->add($updateEmotion);

        //添加'deleteEmotion'权限
        $deleteEmotion=$auth->createPermission('deleteEmotion');
        $deleteEmotion->description='删除情感天地';
        $auth->add($deleteEmotion);

        //添加‘createStar’权限
        $createStar=$auth->createPermission('createStar');
        $createStar->description='添加追星剧场';
        $auth->add($createStar);
        //添加'updateStar'权限
        $updateStar=$auth->createPermission('updateStar');
        $updateStar->description='修改追星剧场';
        $auth->add($updateStar);

        //添加'deleteStar'权限
        $deleteStar=$auth->createPermission('deleteStar');
        $deleteStar->description='删除追星剧场';
        $auth->add($deleteStar);

        //添加‘createCompet’权限
        $createCompet=$auth->createPermission('createCompet');
        $createCompet->description='添加竞技空间';
        $auth->add($createCompet);
        //添加'updateCompet'权限
        $updateCompet=$auth->createPermission('updateCompet');
        $updateCompet->description='修改竞技空间';
        $auth->add($updateCompet);

        //添加'deleteCompet'权限
        $deleteCompet=$auth->createPermission('deleteCompet');
        $deleteCompet->description='删除竞技空间';
        $auth->add($deleteCompet);


        //添加‘createOldbook’权限
        $createOldbook=$auth->createPermission('createOldbook');
        $createOldbook->description='添加旧书市场';
        $auth->add($createOldbook);
        //添加'updateOldbook'权限
        $updateOldbook=$auth->createPermission('updateOldbook');
        $updateOldbook->description='修改旧书市场';
        $auth->add($updateOldbook);

        //添加'deleteOldbook'权限
        $deleteOldbook=$auth->createPermission('deleteOldbook');
        $deleteOldbook->description='删除旧书市场';
        $auth->add($deleteOldbook);



        //添加‘createExam’权限
        $createExam=$auth->createPermission('createExam');
        $createExam->description='添加考试有方';
        $auth->add($createExam);
        //添加'updateExam'权限
        $updateExam=$auth->createPermission('updateExam');
        $updateExam->description='修改考试有方';
        $auth->add($updateExam);

        //添加'deleteExam'权限
        $deleteExam=$auth->createPermission('deleteExam');
        $deleteExam->description='删除考试有方';
        $auth->add($deleteExam);

        //添加‘createMusium’权限
        $createMusium=$auth->createPermission('createMusium');
        $createMusium->description='添加图书馆约';
        $auth->add($createMusium);
        //添加'updateMusium'权限
        $updateMusium=$auth->createPermission('updateMusium');
        $updateMusium->description='修改图书馆约';
        $auth->add($updateMusium);

        //添加'deleteMusium'权限
        $deleteMusium=$auth->createPermission('deleteMusium');
        $deleteMusium->description='删除图书馆约';
        $auth->add($deleteMusium);


        //添加'Roomadmin'并赋予’updateRoom createRoom，deleteRoom‘
        //
        $roomadmin=$auth->createRole('Roomadmin');
        $roomadmin->description='合租空间管理员';
        $auth->add($roomadmin);
        $auth->addChild($roomadmin,$updateRoom);
        $auth->addChild($roomadmin,$createRoom);
        $auth->addChild($roomadmin,$deleteRoom);

        //添加'Travaladmin'并赋予’updateTraval createTraval，deleteTraval‘
        //
        $Travaladmin=$auth->createRole('Travaladmin');
        $Travaladmin->description='旅行故事管理员';
        $auth->add($Travaladmin);
        $auth->addChild($Travaladmin,$updateTraval);
        $auth->addChild($Travaladmin,$createTraval);
        $auth->addChild($Travaladmin,$deleteTraval);

        //添加'Emotionadmin'并赋予’updateEmotion createEmotion，deleteEmotion‘
        //
        $Emotionadmin=$auth->createRole('Emotionadmin');
        $Emotionadmin->description='情感天地管理员';
        $auth->add($Emotionadmin);
        $auth->addChild($Emotionadmin,$updateEmotion);
        $auth->addChild($Emotionadmin,$createEmotion);
        $auth->addChild($Emotionadmin,$deleteEmotion);


        //添加'Staradmin'并赋予’updateStar createStar，deleteStar‘
        //
        $Staradmin=$auth->createRole('Staradmin');
        $Staradmin->description='追星剧场管理员';
        $auth->add($Staradmin);
        $auth->addChild($Staradmin,$updateStar);
        $auth->addChild($Staradmin,$createStar);
        $auth->addChild($Staradmin,$deleteStar);


        //添加'Competadmin'并赋予’updateCompet createCompet，deleteCompet‘
        //
        $Competadmin=$auth->createRole('Competadmin');
        $Competadmin->description='健身空间管理员';
        $auth->add($Competadmin);
        $auth->addChild($Competadmin,$updateCompet);
        $auth->addChild($Competadmin,$createCompet);
        $auth->addChild($Competadmin,$deleteCompet);


        //添加'Oldbookadmin'并赋予’updateOldbook createOldbook，deleteOldbook‘
        //
        $Oldbookadmin=$auth->createRole('Oldbookadmin');
        $Oldbookadmin->description='旧书市场管理员';
        $auth->add($Oldbookadmin);
        $auth->addChild($Oldbookadmin,$updateOldbook);
        $auth->addChild($Oldbookadmin,$createOldbook);
        $auth->addChild($Oldbookadmin,$deleteOldbook);



        //添加'Examadmin'并赋予’updateExam createExam，deleteExam‘
        //
        $Examadmin=$auth->createRole('Examadmin');
        $Examadmin->description='考试有方管理员';
        $auth->add($Examadmin);
        $auth->addChild($Examadmin,$updateExam);
        $auth->addChild($Examadmin,$createExam);
        $auth->addChild($Examadmin,$deleteExam);


        //添加'Musiumadmin'并赋予’updateMusium createMusium，deleteMusium‘
        //
        $Musiumadmin=$auth->createRole('Musiumadmin');
        $Musiumadmin->description='考试有方管理员';
        $auth->add($Musiumadmin);
        $auth->addChild($Musiumadmin,$updateMusium);
        $auth->addChild($Musiumadmin,$createMusium);
        $auth->addChild($Musiumadmin,$deleteMusium);





        // 添加 "admin" 角色并赋予所有其他角色拥有的权限
        $admin = $auth->createRole('admin');
        $admin->description = '系统管理员';
        $auth->add($admin);


        $auth->addChild($admin,$Staradmin);
        $auth->addChild($admin,$roomadmin);
        $auth->addChild($admin,$Travaladmin);
        $auth->addChild($admin,$Emotionadmin);
        $auth->addChild($admin,$Competadmin);
        $auth->addChild($admin,$Oldbookadmin);
        $auth->addChild($admin,$Examadmin);
        $auth->addChild($admin,$Musiumadmin);


        //为用户指派角色。其中1和2是有IdentityInterface::getId返回的id  也即是管理员id
        $auth->assign($admin,3);
        $auth->assign($roomadmin,8);
        $auth->assign($Staradmin,9);
        $auth->assign($Travaladmin,13);
        $auth->assign($Emotionadmin,14);
        $auth->assign($Competadmin,8);
        $auth->assign($Oldbookadmin,8);
        $auth->assign($Examadmin,8);
        $auth->assign($Musiumadmin,8);
    }
}