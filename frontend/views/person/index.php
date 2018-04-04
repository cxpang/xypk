<?php
use yii\helpers\Url;
$this->title = '个人中心';
?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li>
                    个人中心
                </li>
            </ul>
            <div class="panel-group" id="panel-472866">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-472866" href="#panel-element-643103">基本信息</a>
                    </div>
                    <div id="panel-element-643103" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-2"></div> <div class="col-lg-2"style="text-align: right">用户名:</div><div class="col-lg-8"><?=Yii::$app->user->identity->username?></div>
                           </div>
                            <div class="row">
                                <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">头像:</div><div class="col-lg-8"><img alt="140x140" style="width: 200px;height: 220px;" src="<?=Yii::$app->user->identity->upicture?>" class="img-circle" /></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">性别:</div><div class="col-lg-8"><?=Yii::$app->user->identity->sex?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">地址:</div><div class="col-lg-8"><?=Yii::$app->user->identity->address?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">大学:</div><div class="col-lg-8"><?=Yii::$app->user->identity->university?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3"></div><div class="col-lg-2" style="text-align: right"> <button type="button" class="btn btn-primary btn-default" data-toggle="modal" data-target="#infoModal">修改</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-472866" href="#panel-element-871547">安全信息</a>
                    </div>
                    <div id="panel-element-871547" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">原密码:</div><div class="col-lg-8"><input oninput="oldpwdcheck()" type="password" id="oldpassword"><span id="pwderror" style="color: #9A0000;display: none;">原始密码错误</span><span id="pwdright" style="color: #00CC66;display: none;">原始密码正确</span></span></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">新密码:</div><div class="col-lg-8"><input type="password" disabled id="newpassword" placeholder="密码为6-20为字母数字组成"><span id="newpwdtip" style="color: #9A0000;display: none;">密码格式不正确</span></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">重复密码:</div><div class="col-lg-8"><input type="password" disabled id="renewpassword"><span id="renewpwdtip" style="color: #9A0000;display: none;">密码不一致</span></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3"></div><div class="col-lg-2" style="text-align: right"> <button type="button" class="btn btn-primary btn-default" onclick="changepwd()">修改</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-472866" href="#panel-element-871548">绑定信息</a>
                    </div>
                    <div id="panel-element-871548" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">邮箱:</div><div class="col-lg-8"><?=Yii::$app->user->identity->email?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">手机号:</div><div class="col-lg-8"><?=Yii::$app->user->identity->uphone?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--基本信息提交模态框-->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    个人信息修改
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-2"></div> <div class="col-lg-2"style="text-align: right">用户名:</div><div class="col-lg-8"><?=Yii::$app->user->identity->username?></div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">头像:</div><div class="col-lg-6"><img id="userimage" style="width: 200px;height: 220px;" src="<?=Yii::$app->user->identity->upicture?>" class="img-circle" /></div><div class="col-lg-2"><button type="button" class="btn btn-primary btn-default" onclick="inputfile()">更换头像</button><input type="file" id="newimage" onchange="uploadfile()" style="display: none;"><input type="text" style="display: none;" value="<?=Yii::$app->user->identity->upicture?>" id="imagepath"></div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">性别:</div><div class="col-lg-8">
                        <label class="radio-inline">
                            <input type="radio" name="optionsRadiosinline" id="optionsRadios3" value="男" checked> 男
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optionsRadiosinline" id="optionsRadios4"  value="女"> 女
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">地址:</div><div class="col-lg-8"><input type="text" id="useraddress" value="<?=Yii::$app->user->identity->address?>"></div>
                </div>

                <div class="row">
                    <div class="col-lg-2"></div><div class="col-lg-2"style="text-align: right">大学:</div><div class="col-lg-8"><input type="text" id="useruniversity" value="<?=Yii::$app->user->identity->university?>"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-primary" onclick="userinfochange()">
                    确认提交
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
<style type="text/css">
    .row{
        margin-top: 20px;
        font-size: 20px;
        font-family: "Microsoft YaHei";
    }
    input{
        border-radius: 10px;
        border: 1px solid #337ab7;
        font-size: 20px;
    }
</style>
    <script type="text/javascript">
        function inputfile() {
             $("#newimage").click();
        }
        function uploadfile() {
             var file=$("#newimage")[0].files[0];

            var filetype = $('#newimage')[0].value;
            if(!/.(gif|jpg|jpeg|png|gif|jpg|png)$/.test(filetype)) {
                alert("图片类型必须是.gif,jpeg,jpg,png中的一种");
                return false;
            }
                var formdata=new FormData();
             formdata.append('file',file);
             formdata.append('id',<?=Yii::$app->user->identity->id?>);
             var fileurl=getobjurl(file);
             $("#userimage").attr("src", fileurl) ;
             $.ajax({
                 url:'<?=Url::to(['person/uploadimage']) ?>',
                 type:'POST',
                 cache:false,
                 data:formdata,
                 dataType:'json',
                 processData:false,
                 contentType:false,
                 success:function (data) {
                     $("#imagepath").val(data.msg);
                 }
             })


        }
        function getobjurl(file) {
            var url = null ;
            if (window.createObjectURL!=undefined) { // basic
                url = window.createObjectURL(file) ;
            } else if (window.URL!=undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file) ;
            } else if (window.webkitURL!=undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file) ;
            }
            return url ;

        }
        function  userinfochange() {
            var sex=$('input:radio:checked').val();
            var image=$("#imagepath").val();
            var address=$("#useraddress").val();
            var university=$("#useruniversity").val();
            var formdata=new FormData();
            formdata.append('id',<?=Yii::$app->user->identity->id?>);
            formdata.append('sex',sex);
            formdata.append('image',image);
            formdata.append('address',address);
            formdata.append('univesrsity',university);
            $.ajax({
                url:'<?=Url::to(['person/changestaticinfo']) ?>',
                type:'POST',
                cache:false,
                data:formdata,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function (data) {
                    if(data){
                        window.location.reload();
                    }

                }
            })


        }
        function oldpwdcheck() {
            $("#pwderror").show();
            var oldpwd=$("#oldpassword").val();
            var formdata=new FormData();
            formdata.append('id',<?=Yii::$app->user->identity->id?>);
            formdata.append('oldpwd',oldpwd);
            $.ajax({
                url:'<?=Url::to(['person/checkoldpwd']) ?>',
                type:'POST',
                cache:false,
                data:formdata,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function (data) {
                    if(data){
                       $("#pwderror").hide();
                       $("#pwdright").show();
                       $("#newpassword").removeAttr("disabled");
                       $("#renewpassword").removeAttr("disabled");
                       $("#newpassword").focus();

                    }

                }
            })

        }
        function changepwd() {
            var newpwd=$("#newpassword").val();
            var renewpwd=$("#renewpassword").val();
            var ret = /^[a-zA-Z0-9_]{6,20}$/;
            if(ret.test(newpwd)){
                $("#newpwdtip").hide();
                if(renewpwd!=newpwd){
                    $("#renewpwdtip").show();
                }
                else{
                    $("#renewpwdtip").hide();
                    var formdata=new FormData();
                    formdata.append('id',<?=Yii::$app->user->identity->id?>);
                    formdata.append('newpwd',newpwd);
                    $.ajax({
                        url:'<?=Url::to(['person/changepwd']) ?>',
                        type:'POST',
                        cache:false,
                        data:formdata,
                        dataType:'json',
                        processData:false,
                        contentType:false,
                        success:function (data) {
                            if(data){
                                window.location.reload();
                            }

                        }
                    })
                }
            }else{
                $("#newpwdtip").show();
            }

        }
    </script>
