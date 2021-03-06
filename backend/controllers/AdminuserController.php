<?php

namespace backend\controllers;

use backend\models\Resetpwd;
use common\models\AuthAssignment;
use common\models\AuthItem;
use Yii;
use common\models\Adminuser;
use common\models\AdminuserSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Adminsign;

/**
 * AdminuserController implements the CRUD actions for Adminuser model.
 */
class AdminuserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Adminuser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminuserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adminuser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Adminuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Adminsign();

        if ($model->load(Yii::$app->request->post())) {
            if($user=$model->signup()){
//                var_dump($model);exit(0);打印$model数据显示不存在id字段
                return $this->redirect(['view', 'id' => $user->id]);
            }
            else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Adminuser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Adminuser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Adminuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Adminuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adminuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionResetpwd($id){
        $model=new Resetpwd();
        if($model->load(Yii::$app->request->post())){
            if($model->resetPassword($id)){
                return $this->redirect(['index']);
            }
        }
        return $this->render('resetpwd',[
            'model'=>$model,
        ]);
    }
    public function actionPrivilege($id){
        if(Yii::$app->user->id!=3){
             throw new ForbiddenHttpException('对不起，您不是系统管理员');
        }
        //第一步找出所有权限，提供给checkbox
        $allprivileges=AuthItem::find()->select(['name','description'])->where(['type'=>1])->orderBy('description')->all();
        foreach ($allprivileges as $pri){
            $allprivilegesArray[$pri->name]=$pri->description;

        }
        //第二步找出当前用户的权限
        $authAssignments=AuthAssignment::find()->select(['item_name'])->where(['user_id'=>$id])->all();
        $authAssignmentsarray=array();
        foreach ($authAssignments as $authAssignment){
            array_push($authAssignmentsarray,$authAssignment->item_name);
        }
        //第三部，根据表单提交的数据更新AuthAssignment表，从而使用户角色发送变化
        if(isset($_POST['newPri'])){
            $result=AuthAssignment::find()->where(['user_id'=>$id])->all();
            if($result){
            AuthAssignment::deleteAll('user_id=:id',[':id'=>$id]);
            }
            $newPri=$_POST['newPri'];
            $arrlen=count($newPri);
            for($x=0;$x<$arrlen;$x++){
                $apri=new AuthAssignment();
                $apri->item_name=$newPri[$x];
                $apri->user_id=$id;
                $apri->created_at=time();
                $apri->save();

            }
            return $this->redirect(['index']);
        }

        //第四部，渲染表单
        return $this->render('privilege',['id'=>$id,'allprivilegesArray'=>$allprivilegesArray,
            'authAssignmentsarray'=>$authAssignmentsarray]);

    }
}
