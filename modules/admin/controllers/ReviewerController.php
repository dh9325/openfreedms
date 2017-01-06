<?php

namespace modules\admin\controllers;

use common\models\forms\CreateReviewer;
use Yii;
use common\models\Reviewer;
use common\models\search\ReviewerSearch;
use modules\admin\controllers\BaseAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReviewerController implements the CRUD actions for Reviewer model.
 */
class ReviewerController extends BaseAdminController
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
     * Lists all Reviewer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reviewer model.
     * @param integer $user_id
     * @param integer $department_id
     * @return mixed
     */
    public function actionView($user_id, $department_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $department_id),
        ]);
    }

    /**
     * Creates a new Reviewer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreateReviewer();
        if (Yii::$app->getRequest()->isPost) {
            $model->load(Yii::$app->request->post());
            if ($this->system->addReviewer($model->user, $model->department)) {
                return $this->redirect(['view', 'user_id' => $model->user, 'department_id' => $model->department]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reviewer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $department_id
     * @return mixed
     */
    public function actionUpdate($user_id, $department_id)
    {
        $model = $this->findModel($user_id, $department_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'department_id' => $model->department_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reviewer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $department_id
     * @return mixed
     */
    public function actionDelete($user_id, $department_id)
    {
        $this->findModel($user_id, $department_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reviewer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $department_id
     * @return Reviewer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $department_id)
    {
        if (($model = Reviewer::findOne(['user_id' => $user_id, 'department_id' => $department_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
