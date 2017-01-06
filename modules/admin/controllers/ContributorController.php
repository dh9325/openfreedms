<?php

namespace modules\admin\controllers;

use common\models\forms\CreateContributor;
use Yii;
use common\models\Contributor;
use common\models\search\ContributorSearch;
use modules\admin\controllers\BaseAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContributorController implements the CRUD actions for Contributor model.
 */
class ContributorController extends BaseAdminController
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
     * Lists all Contributor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContributorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contributor model.
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
     * Creates a new Contributor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreateContributor();
        if (Yii::$app->getRequest()->isPost) {
            $model->load(Yii::$app->request->post());
            if ($this->system->addContributor($model->user, $model->department)) {
                return $this->redirect(['view', 'user_id' => $model->user, 'department_id' => $model->department]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contributor model.
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
     * Deletes an existing Contributor model.
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
     * Finds the Contributor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $department_id
     * @return Contributor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $department_id)
    {
        if (($model = Contributor::findOne(['user_id' => $user_id, 'department_id' => $department_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
