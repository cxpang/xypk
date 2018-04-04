<?php

namespace backend\controllers;

use Yii;
use common\models\Exam;
use common\models\ExamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;

/**
 * ExamController implements the CRUD actions for Exam model.
 */
class ExamController extends Controller
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
     * Lists all Exam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Exam model.
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
     * Creates a new Exam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function upload($model){
        $image=UploadedFile::getInstance($model, 'examimage');
        $ext=$image->getExtension();
        $imageName=time().rand(100,900).'.'.$ext;
        $path='../../uploads/';
        $image->saveAs($path.$imageName);
        $model->examimage='/xypk/uploads/'.$imageName;
        return $model;
    }
    public function actionCreate()
    {
        if(!Yii::$app->user->can('createExam')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = new Exam();

        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->examid]);
            }
        }
        else{
            var_dump($model->getErrors());
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Exam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('updateExam')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->examid]);
            }
        }
        else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Exam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('deleteExam')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
