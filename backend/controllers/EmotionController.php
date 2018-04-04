<?php

namespace backend\controllers;

use Yii;
use common\models\emotion;
use common\models\EmotionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;

/**
 * EmotionController implements the CRUD actions for emotion model.
 */
class EmotionController extends Controller
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
     * Lists all emotion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmotionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single emotion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function upload($model){
        $image=UploadedFile::getInstance($model, 'emotionimage');
        $ext=$image->getExtension();
        $imageName=time().rand(100,900).'.'.$ext;
        $path='../../uploads/';
        $image->saveAs($path.$imageName);
        $model->emotionimage='/xypk/uploads/'.$imageName;
        return $model;
    }

    /**
     * Creates a new emotion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('createEmotion')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = new emotion();

        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->emotionid]);
            }
        }
        else{
            var_dump($model->getErrors());
            return $this->render('create', [
                'model' => $model,
            ]);
        }
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->emotionid]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Updates an existing emotion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('updateEmotion')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->emotionid]);
            }
        }
        else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing emotion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('deleteEmotion')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the emotion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return emotion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = emotion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
