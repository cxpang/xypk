<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use janisto\timepicker\TimePicker;
$count=count($content);
$this->title = '旅行故事详细信息';

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
                    <a href="<?=Url::to(['travel/index'])?>">旅行故事</a>
                </li>
                <li class="active">
                    <?php echo $travaldetail[0]['travalname']  ?>
                </li>
            </ul>
            <p class="text-center text-info lead" style="margin-top: 50px;font-size: 25px">
                <strong><?=$travaldetail[0]['travalname']   ?></strong>
            </p>
            <dl class="dl-horizontal" style="font-size: 15px;font-family: 'Microsoft YaHei'">
                <dt>
                    旅行价格:
                </dt>
                <dd style="color: #9A0000">
                    <strong><?=$travaldetail[0]['travalprice']   ?>RMB</strong>
                </dd>
                <dt>
                    时间:
                </dt>
                <dd style="color: #9A0000">
                    <strong><?=$travaldetail[0]['travaltime']   ?>RMB</strong>
                </dd>

                <dt>
                    天数:
                </dt>
                <dd style="color: #9A0000">
                    <strong><?=$travaldetail[0]['travaldays']   ?></strong>
                </dd>
                <dt>
                    内容:
                </dt>
                <dd>
                    <strong><?=$travaldetail[0]['travalcontent']   ?></strong>
                </dd>
                <dt style="margin-top: 15px;">
                    发布人:
                </dt>
                <dd>
                    <strong><?=$travaldetail[0]['username'] ?></strong>
                    <?php if(yii::$app->user->identity->getId()!=$travaldetail[0]['uid']){ ?>
                        <button type="button" class="btn btn-default btn-lg" style="margin-left: 150px" onclick="returnchat();">
                            <span class="glyphicon glyphicon-envelope"></span>发送私信
                        </button>
                    <?php }?>
                </dd>
                <dt>
                    邮箱:
                </dt>
                <dd>
                    <strong><?=$travaldetail[0]['email']   ?></strong>
                </dd>
                <dt>
                    手机号:
                </dt>
                <dd>
                    <strong><?=$travaldetail[0]['uphone']   ?></strong>
                </dd>
                <dt>
                    发布时间:
                </dt>
                <dd>
                    <strong><?=date('Y-m-d H:i:s',$travaldetail[0]['createtime'])   ?></strong>
                </dd>
                <dt>
                    合租状态:
                </dt>
                <dd>
                    <strong><?=$travaldetail[0]['status']   ?></strong>
                </dd>
                <?php if(yii::$app->user->identity->getId()==$travaldetail[0]['uid']){ ?>
                    <dt>
                        操作:
                    </dt>
                    <dd>
                        <button class="btn btn-primary" onclick="finshtraval('<?=$travaldetail[0]['travalid']?>','<?=$travaldetail[0]['status']?>');">结贴</button>
                        <button class="btn btn-primary" onclick="deletetraval('<?=$travaldetail[0]['travalid']?>');">删除</button>
                    </dd>
                <?php }?>
            </dl>
            <div class="carousel slide"  id="carousel-612878">
                <div class="carousel-inner">
                    <div class="item active" >
                        <img  alt="" class="center-block" style="height: 500px;width: 1600px" src="<?=$travaldetail[0]['travalimage'] ?>" />
                        <div class="carousel-caption">
                            <h4>
                                旅行照片
                            </h4>
                        </div>
                    </div>
                </div> <a class="left carousel-control" href="#carousel-612878" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-612878" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>

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
                                        <em><?=$row['travalcontent']?></em>
                                    </p>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#showmorecontent" onclick="showmoreres(<?=$row['travalcommentid']?>)">查看更多回复</button><br />
                                </div>
                                <div class="col-md-2" style="margin-top: 50px">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#rescontent" onclick="editres(<?=$row['travalcommentid']?>)">回复</button><br />
                                    <?=date('Y-m-d H:i:s',$row['createtime'])?>
                                </div>
                            </div>

                        <?php  }}?>
                    </div>
                    <div class="tab-pane active" id="panel-988930">
                        <?php $form = ActiveForm::begin(['method' => "post",'action'=>Url::to(['travel/addcontent']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>
                        <div class="col-md-12">
                            评论内容:<input type="textarea" style="height: 50px" required class="form-control" name="contenttext">

                        </div>
                        <input type="text" name="uid" style="display: none" value="<?=Yii::$app->user->identity->id?>">
                        <input type="text" name="travalid" style="display: none" value="<?=$travaldetail[0]['travalid']?>">
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
        <?php $form = ActiveForm::begin(['method' => "post",'action'=>Url::to(['travel/addres']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">请输入回复内容</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="travalid" value="<?=Yii::$app->request->get('travalid')?>" style="display: none">

                <input type="text" class="form-control" name="travalcommontid" id="travalcommontid" style="display: none">
                <input type="text" class="form-control" name="uid" id="uid" value="<?=Yii::$app->user->getId()?>" style="display: none">
                <input type="text" class="form-control" name="travalcommontres" id="travalcommontres" required>
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
    function editres(id) {
        $("#travalcommontid").val(id);
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
    function showmoreres(travalcommontid) {
        var travalcommontid=travalcommontid;
        var formdata=new FormData();
        formdata.append('travalcommontid',travalcommontid);
        $.ajax({
            url:'<?=Url::to(['travel/showcontentres']) ?>',
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
                        div+="<span>"+objval['travalcommentrestext']+"</span>";
                        div+="<span style='float: right'>"+formatetime(objval['createtime'])+"</span>";
                        div+="</div>";
                        $("#test").append(div);



                    })
                }

            }
        })

    }
    function finshtraval(travalid,status) {
        if(status=='已结贴'){
            alert("您无须进行该操作");
            return false;
        }
        var formdata=new FormData();
        formdata.append('travalid',travalid);
        $.ajax({
            url: '<?=Url::to(['travel/finishtraval']) ?>',
            type: 'POST',
            cache: false,
            data: formdata,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                if(data){
                    alert("恭喜您，结贴完成");
                    window.location.reload();
                }
            }
        })
    }
    function deletetraval(traval) {
        var formdata=new FormData();
        formdata.append('travalid',traval);
        $.ajax({
            url: '<?=Url::to(['travel/deletetraval']) ?>',
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
    function returnchat() {
        window.open("<?=Url::to(['chatpoint/index','tochatid'=>$travaldetail[0]['uid']])?>");
    }
</script>

