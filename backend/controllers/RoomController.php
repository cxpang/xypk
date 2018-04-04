<?php

namespace backend\controllers;

use Yii;
use common\models\Room;
use common\models\RoomSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
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
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        }
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Room model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//        $test= $this->findModel($id);
//        $test->status0->username;
//        var_dump($test->status0->email);
//        exit(0);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('createRoom')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = new Room();
        $model->createtime=time();
        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->roomid]);
            }
        }
        else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->roomid]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
    }
    public function upload($model){
        $image=UploadedFile::getInstance($model, 'roomimage');
        $ext=$image->getExtension();
        $imageName=time().rand(100,900).'.'.$ext;
        $path='../../uploads/';
        $image->saveAs($path.$imageName);
        $model->roomimage='/xypk/uploads/'.$imageName;
        return $model;
    }

    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('updateRoom')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->roomid]);
            }
        }
        else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->roomid]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Deletes an existing Room model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('deleteRoom')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('您访问的页面不存在.');
        }
    }
}
