<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use janisto\timepicker\TimePicker;
use common\models\Emotion;
$this->title = $data[0]['emotionname'];
$count=count($content);
?>

<div class="container" style="margin-top: 80px;margin-bottom: 100px">
    <div class="row clearfix">
        <div class="col-md-2 column">
            <img style="width: 150px;height: 150px;margin-bottom: 50px" alt="140x140" src="<?php  echo Yii::$app->user->identity->upicture;?>" class="img-circle" />
            <p class="lead text-success">
                当前用户:<strong><?php echo Yii::$app->user->identity->username   ?></strong>
            </p>
            <p class="lead text-success">
                用户经验:<strong><?php echo Yii::$app->user->identity->expe   ?></strong>
            </p>
        </div>
        <div class="col-md-10 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li>
                    <a href="<?=Url::to(['emotion/index'])?>">情感天地</a>
                </li>
                <li class="active">
                    <?php echo $data[0]['emotionname']  ?>
                </li>
            </ul>
            <div class="page-header">
                </ul><img alt="80x80" style="width: 80px;height: 80px;" src="<?=$data[0]['upicture']?>" class="img-circle" /><?=$data[0]['username']?><span style="float: right;margin-top: 25px;">分享时间<?=date('Y-m-d',$data[0]['createtime'])?></span>
                <?php if(yii::$app->user->identity->getId()==$data[0]['uid']){ ?>
                    <dd>
                        <button class="btn btn-primary" onclick="deleteemotion('<?=$data[0]['emotionid']?>');">删除</button>
                    </dd>
                <?php }?>
            </div>
            <h3 class="text-center text-success">
                <?=$data[0]['emotionname']?>
            </h3>
            <div class="carousel slide"  id="carousel-612878">
                <div class="carousel-inner">
                    <div class="item active" >
                        <img  alt="" class="center-block" style="height: 500px;width: 1600px" src="<?=$data[0]['emotionimage'] ?>" />
                    </div>
                </div> <a class="left carousel-control" href="#carousel-612878" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-612878" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
            <p class="text-center muted lead">
                <strong><?=$data[0]['emotioncontent']?></strong>
            </p>

            <div class="tabbable" id="tabs-721112" style="margin-top: 50px">
                <ul class="nav nav-tabs">
                    <li>
                        <a href="#panel-966835" data-toggle="tab"><span class="badge pull-right"><?=$count?></span>评论信息</a>
                    </li>
                    <li class="active">
                        <a href="#panel-988930" data-toggle="tab">发表评论</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="panel-966835">
                        <!--                        这里循环展示评论信息-->

                        <?php
                        if(isset($content)){
                            foreach ($content as $row){  ?>
                                <div class="col-md-12" style="border: 1px solid #ddd">
                                    <div class="col-md-2" style="margin-top: 20px">
                                        <img style="width: 80px;height: 80px" title="评论人:<?=$row['username']?>" class="img-circle" src="<?=$row['upicture']?>">
                                        <br />
                                        <span style="margin-left: 10px;"><?=$row['username']?></span>
                                    </div>
                                    <div class="col-md-8" style="margin-top: 50px;font-size: 20px">
                                        <p>
                                            <em><?=$row['emotioncontent']?></em>
                                        </p>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#showmorecontent" onclick="showmoreres(<?=$row['emotioncommentid']?>)">查看更多回复</button><br />
                                    </div>
                                    <div class="col-md-2" style="margin-top: 50px">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#rescontent" onclick="editres(<?=$row['emotioncommentid']?>)">回复</button><br />
                                        <?=date('Y-m-d H:i:s',$row['createtime'])?>
                                    </div>
                                </div>

                            <?php  }}?>
                    </div>
                    <div class="tab-pane active" id="panel-988930">
                        <?php $form = ActiveForm::begin(['method' => "post",'action'=>Url::to(['emotion/addcontent']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>
                        <div class="col-md-12">
                            评论内容:<input type="textarea" style="height: 50px" required class="form-control" name="contenttext">
                        </div>
                        <input type="text" name="uid" style="display: none" value="<?=Yii::$app->user->identity->id?>">
                        <input type="text" name="emotionid" style="display: none" value="<?=$data[0]['emotionid']?>">
                        <input type="submit" style="margin-left: 20px;margin-top: 50px" name="search_submit" value="提交" class="btn btn-primary">
                        <?php $form = ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="rescontent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <?php $form = ActiveForm::begin(['method' => "post",'action'=>Url::to(['emotion/addres']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">请输入回复内容</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="emotionid" value="<?=Yii::$app->request->get('emotionid')?>" style="display: none">
                <input type="text" class="form-control" name="emotioncommontid" id="emotioncommontid" style="display: none">
                <input type="text" class="form-control" name="uid" id="uid" value="<?=Yii::$app->user->getId()?>" style="display: none">
                <input type="text" class="form-control" name="emotioncommontres" id="emotioncommontres" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary">确定</button>
            </div>
        </div>
        <?php $form = ActiveForm::end(); ?>
    </div>
</div>
<div class="modal fade" id="showmorecontent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                更多回复信息
            </div>
            <div class="modal-body" style="font-size: 18px" id="test" >

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearall()">关闭</button>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteemotion(emotionid) {
        var formdata=new FormData();
        formdata.append('emotionid',emotionid);
        $.ajax({
            url: '<?=Url::to(['emotion/deleteemotion']) ?>',
            type: 'POST',
            cache: false,
            data: formdata,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data){
                if(data){
                    alert("删除成功");
                    window.location.href=document.referrer;
                }
            }
        })
    }
    function editres(id) {
        $("#emotioncommontid").val(id);
    }
    function clearall() {
        $("#test").empty()

    }
    function formatetime(time) {
        var now= new Date(parseInt(time)*1000);
        var year = now.getFullYear(),
            month = now.getMonth() + 1,
            date = now.getDate(),
            hour = now.getHours(),
            minute = now.getMinutes(),
            second = now.getSeconds();
        timeFormat = year + "-" + month + "-" + date + " " + hour + ":" + minute + ":" + second;

        return timeFormat;
    }
    function showmoreres(emotioncommontid) {
        var travalcommontid=emotioncommontid;
        var formdata=new FormData();
        formdata.append('emotioncommontid',emotioncommontid);
        $.ajax({
            url:'<?=Url::to(['emotion/showcontentres']) ?>',
            type:'POST',
            cache:false,
            data:formdata,
            dataType:'json',
            processData:false,
            contentType:false,
            success:function (data) {
                if(data){
                    var jsondata=eval(data);
                    $.each(jsondata,function (index,objval) {
                        var div="<div>";
                        div+="<span>"+objval['username']+":";
//                         div+="<img src='";
//                         div+=+objval['upicture']+"'";
//                         div+=">";
                        div+="</span>";
                        div+="<span>"+objval['emotioncommentrestext']+"</span>";
                        div+="<span style='float: right'>"+formatetime(objval['createtime'])+"</span>";
                        div+="</div>";
                        $("#test").append(div);



                    })
                }

            }
        })

    }
</script>
