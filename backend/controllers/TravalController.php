<?php

namespace backend\controllers;

use Yii;
use common\models\Traval;
use common\models\TravalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;

/**
 * TravalController implements the CRUD actions for Traval model.
 */
class TravalController extends Controller
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
     * Lists all Traval models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TravalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Traval model.
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
     * Creates a new Traval model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('createTraval')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = new Traval();
        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->travalid]);
            }
        }
        else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->travalid]);
//        } else {
//            var_dump($model->getErrors());
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
    }
    public function upload($model){
        $image=UploadedFile::getInstance($model, 'travalimage');
        $ext=$image->getExtension();
        $imageName=time().rand(100,900).'.'.$ext;
        $path='../../uploads/';
        $image->saveAs($path.$imageName);
        $model->travalimage='/xypk/uploads/'.$imageName;
        return $model;
    }

    /**
     * Updates an existing Traval model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('updateTraval')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->travalid]);
            }
        }
        else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Traval model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('deleteTraval')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Traval model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Traval the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Traval::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
