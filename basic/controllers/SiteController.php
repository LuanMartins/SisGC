<?php

namespace app\controllers;

use app\models\Cliente;
use app\models\User;
use app\models\Venda;
use kartik\form\ActiveField;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\db\Query;
use yii\web\ForbiddenHttpException;
use yii\data\ActiveDataProvider;
use app\models\VendaSearch;
class SiteController extends Controller
{
    public $layout = 'newmain';
    /**
     * @inheritdoc
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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionPdf($data){



        return $data;

    }
    public function actionIndex()
    {



        if (!Yii::$app->user->isGuest) {

            $model = new Venda();
            $modelCliente = new Cliente();

            $searchModel = new VendaSearch();
            $dataProvider = new ActiveDataProvider([
                'query' => Venda::find()->joinWith('compradorIdcomprador')->joinWith('user')->orderBy('data_venda'),
                'pagination' => [
                    'pageSize' => 10,
                ],



            ]);

            return $this->render('index',['model'=>$model,'modelCliente' => $modelCliente,
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel
            ]);

        }

        return $this->render('index');
    }


    public function actionPesquisa($nome){



        if(Yii::$app->request->get()) {

            

            $dataProvider = new ActiveDataProvider(
                ['query' => Venda::find()->joinWith('compradorIdcomprador')->where(['nome' => $nome]),
                    'pagination' => [
                        'pageSize' => 10,
                    ],


                ]
            );


            $model = new Venda();

            $valorTotal = Venda::find()->joinWith('compradorIdcomprador')->where(['like','nome',$nome])->sum('valor');


            //return var_dump($valorTotal);

            if($dataProvider->count == 0){

                $dataProvider = new ActiveDataProvider(
                    ['query' => Venda::find()->joinWith('compradorIdcomprador')->where(['like','apelido',$nome]),
                        'pagination' => [
                          'pageSize' => 10,
                        ],


                    ]
                );

                $valorTotal = Venda::find()->joinWith('compradorIdcomprador')->where(['apelido' => $nome])->sum('valor');

            }
            //return $dataProvider;

           return $this->render('resultados',['dataProvider'=>$dataProvider,'valorTotal'=>$valorTotal,'model' => $model]);
        }else{


            throw new ForbiddenHttpException;
        }

    }
    
    
    public function actionAtualizar($id){
        
        $venda = Venda::findOne($id);

        return var_dump($venda);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            //$resultados = User::find()->where(['id'=>$model->getId()])->one();

            //return $this->render('index',['resultado'=>$resultados]);
          return $this->redirect('index');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */

    public function actionClienteList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('idcomprador, nome AS text')
                ->from('cliente')
                ->where(['like', 'nome', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);

        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Cliente::find($id)->nome];


        }
        return $out;
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
