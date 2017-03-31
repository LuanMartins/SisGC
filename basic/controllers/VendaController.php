<?php

namespace app\controllers;

use app\models\Cliente;
use app\models\Historico;
use app\models\User;
use Yii;
use app\models\Venda;
use app\models\VendaSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * VendaController implements the CRUD actions for Venda model.
 */
class VendaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view','update','delete','create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Venda models.
     * @return mixed
     */
    public function actionIndex()
    {
            $searchModel = new VendaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Venda model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$nome)
    {
        $this->layout = 'newmain';
        return $this->render('view', [
            'model' => $this->findModel($id),
            'nome' => $nome
        ]);
    }

    /**
     * Creates a new Venda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Venda();
        $modelHistorico = new Historico();

        if ($model->load(Yii::$app->request->post())) {

            
            $model->user_id = Yii::$app->user->getId();
            $model->data_venda = date('d - m - Y');


            $idUser = User::findOne(Yii::$app->user->getId());
            $idCliente = Cliente::findOne($model->comprador_idcomprador);

            $modelHistorico->data = date('d - m - Y');
            $modelHistorico->nome_cliente = $idCliente->nome;
            $modelHistorico->nome_vendedor = $idUser->username;
            $modelHistorico->valor = $model->valor;

            if($model->save() && $modelHistorico->save()){

                Yii::$app->session->setFlash('vendaEfetuada');
                
                return $this->redirect('index.php?r=site/index');

            }else{

                return "Nao deu certo";
            }


            // return $this->redirect(['view', 'id' => $model->idcompra]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Venda model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {

        $model = $this->findModel($_POST['id']);
        $valorAntigo = Venda::findOne($_POST['id']);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->data_venda = date('d - m - Y');
            $model->valor = $valorAntigo->valor - $model->valor;
            if ($model->save()) {

                Yii::$app->session->setFlash('alteracaoEfetuada');
                return $this->redirect(Url::to(['site/pesquisa']));
            }
        } 
        
            throw new ForbiddenHttpException;
            
    }

    /**
     * Deletes an existing Venda model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('exclusaoEfetuada');

        return $this->redirect('index.php?r=site/pesquisa');
    }

    /**
     * Finds the Venda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Venda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Venda::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
