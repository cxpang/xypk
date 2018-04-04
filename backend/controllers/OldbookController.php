<?php

namespace backend\controllers;

use Yii;
use common\models\Oldbook;
use common\models\OldbookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;

/**
 * OldbookController implements the CRUD actions for Oldbook model.
 */
class OldbookController extends Controller
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
     * Lists all Oldbook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OldbookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Oldbook model.
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
        $image=UploadedFile::getInstance($model, 'oldbookimage');
        $ext=$image->getExtension();
        $imageName=time().rand(100,900).'.'.$ext;
        $path='../../uploads/';
        $image->saveAs($path.$imageName);
        $model->oldbookimage='/xypk/uploads/'.$imageName;
        return $model;
    }

    /**
     * Creates a new Oldbook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('createOldbook')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = new Oldbook();

        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->oldbookid]);
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
     * Updates an existing Oldbook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('updateOldbook')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())){
            $model=self::upload($model);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->oldbookid]);
            }
        }
        else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Oldbook model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('deleteOldbook')){
            throw new ForbiddenHttpException('对不起您没有进行该操作的权限');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Oldbook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Oldbook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Oldbook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
