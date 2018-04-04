<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use janisto\timepicker\TimePicker;
$this->title = '聊天中心';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <link rel="stylesheet" type="text/css" href="./css/chat.css" />
</head>
<body>
<div class="col-md-12">
    <div class="chatBox">
        <div class="chatLeft">
            <div class="chat01">
                <div class="chat01_title">
                    <ul class="talkTo">
                        <li><a href="javascript:;"><?=isset($tousers[0]['username'])?$tousers[0]['username']:$touserall[0]['username'] ?></a></li></ul>
                    <a class="close_btn" href="javascript:;"></a>
                </div>
                <div class="chat01_content">
                    <div class="message_box mes1">
                    </div>
                    <div class="message_box mes2">
                    </div>
                    <div class="message_box mes3" id="txtcontent" style="display: block;">
                    </div>
                    <div class="message_box mes4">
                    </div>
                    <div class="message_box mes5">
                    </div>
                    <div class="message_box mes6">
                    </div>
                    <div class="message_box mes7">
                    </div>
                    <div class="message_box mes8">
                    </div>
                    <div class="message_box mes9">
                    </div>
                    <div class="message_box mes10">
                    </div>
                </div>
            </div>
            <div class="chat02">
                <div class="chat02_title">
                    <label class="chat02_title_t">
                        <a href="chat.htm" target="_blank">聊天记录</a>
                    </label>
                </div>
                <div class="chat02_content">
                    <textarea id="textarea"></textarea>
                </div>
                <div class="chat02_bar">
                    <ul>
                        <li style="right: 5px; top: 5px;">
                            <a href="javascript:sendmessage()
                            ;">
                                <img src="img/send_btn.jpg">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="chatRight">
            <div class="chat03">
                <div class="chat03_title">
                    <label class="chat03_title_t">
                        成员列表</label>
                </div>
                <div class="chat03_content">
                    <ul>
                        <li class="choosed">
                            <label class="offline">
                            </label>
                            <a href="javascript:;">
                                <img src="<?=isset($tousers[0]['upicture'])?$tousers[0]['upicture']:$touserall[0]['upicture'] ?>"></a><a href="javascript:;" class="chat03_name"><?=isset($tousers[0]['username'])?$tousers[0]['username']:$touserall[0]['username'] ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div style="clear: both;">
        </div>
    </div>
</div>
<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">
    <p></p>
    <p></p>
</div>

<br><br>
</body>
</html>
<script type="text/javascript">
    var socket = null; //初始为null
    var touser=null;
    var isLogin = false; //是否登录到服务器上
    window.onload = function(){
        var userid="<?=Yii::$app->user->identity->getId()?>";
        socket = new WebSocket("ws://120.79.130.178:8484");
        socket.onopen = function() {
            socket.send('login:' + userid);
        };
        socket.onmessage=function (e) {
            var getMsg = e.data;
            if(/^notice:success$/.test(getMsg)) { //服务器验证通过
                isLogin = true;
            }
            else if(/^msg:/.test(getMsg)) { //代表是普通消息
                console.log(getMsg);
                var i="<div class='message clearfix'><div class='user-logo'><img style='width:50px;height:50px;' src='" +"<?=isset($tousers[0]['upicture'])?$tousers[0]['upicture']:$touserall[0]['upicture']?>"+ "'/>" + "</div>"
                i+="<div class='wrap-text'>"+"<h5 class='clearfix'>"+"<?=isset($tousers[0]['username'])?$tousers[0]['username']:$touserall[0]['username']?>"+"</h5><div>"+getMsg.replace('msg:','')+"</div>";
                i+="</div>";
                $("#txtcontent").append(i);
            }
            else if(/^users:/.test(getMsg)){ //显示当前已登录用户
                console.log(getMsg);


                getMsg = getMsg.replace('users:','');
                getMsg= eval('('+getMsg+')'); //转json
                findkey(getMsg);


            }

        }
        socket.onclose = function(){
            isLogin = false;
        }
    }
    function sendmessage() {
        var message=$("#textarea").val();
        socket.send('chat:<'+touser+'>:'+message);

        var i="<div class='message clearfix'><div class='user-logo'><img style='width:50px;height:50px;' src='" +"<?=Yii::$app->user->identity->upicture?>"+ "'/>" + "</div>"
        i+="<div class='wrap-text'>"+"<h5 class='clearfix'>"+"<?=Yii::$app->user->identity->username?>"+"</h5><div>"+message+"</div>";
        i+="</div>";
        $("#txtcontent").append(i);
        $("#textarea").val("");
    }

    function findkey(obj) {
        $.each(obj, function(key, val) {
            if(val=="<?=isset($tousers[0]['id'])?$tousers[0]['id']:$touserall[0]['fromid'] ?>"){
                touser= key;
            }
        });
    }

</script>