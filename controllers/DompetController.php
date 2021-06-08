<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Dompet;
use yii\data\SqlDataProvider;
use yii\web\NotFoundHttpException;

class DompetController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $provider = new SqlDataProvider([
            'sql' => "SELECT * FROM dompet",
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        $newModel = $provider->getModels();
        foreach ($newModel as $key => $value){
            $newModel[$key]["action"] = ($value['action'] == 0) ? "Pengeluaran" : "Pemasukan";
            $newModel[$key]["description"] = ($value['description'] == "''") ? "" : $value['description'];
        }
        print_r($provider->setModels($newModel));
        return $this->render("index", [
            'dataProvider' => $provider
        ]);
    }
    public function actionCreate()
    {
        $model = new Dompet();
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->date = date('Y-m-d', strtotime(str_replace('.', '/', $model->date)));
            $model->amount = str_replace('.', '', $model->amount);
            $model->save();
            $this->redirect("index");
        }
        return $this->render("create");
    }
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render("edit", [
            'model' => $model
        ]);
    }
    protected function findModel($id)
    {
        if (($model = Dompet::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}