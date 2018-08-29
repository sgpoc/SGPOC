<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\GestorGruposTrabajo;
use app\models\GruposTrabajo;
use app\models\GruposTrabajoBuscar;


class GruposTrabajoController extends Controller
{   
    public function actionListar()
    {       
        $gestor = new GestorGruposTrabajo;
        $searchModel = new GruposTrabajoBuscar;
        if($searchModel->load(Yii::$app->request->get()) && $searchModel->validate())
        {
            $pGrupoTrabajo = $searchModel['GrupoTrabajo'];
            $pMail = $searchModel['Mail'];
            $pEstado = $searchModel['Estado'];
            $grupostrabajo = $gestor->Buscar($pGrupoTrabajo, $pMail, $pEstado);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $grupostrabajo,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
        else{
            $grupostrabajo = $gestor->Listar();
            $dataProvider = new ArrayDataProvider([
                'allModels' => $grupostrabajo,
                'pagination' => ['pagesize' => 5,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
    }
    
    public function actionListarUsuarios()
    {    
        $gestor = new GestorUsuarios;
        $gestorgt = new GestorGruposTrabajo;
        $roles = $gestor->ListarRoles();
        $listDataR = ArrayHelper::map($roles,'IdRol','Rol');
        $pIdGT = Yii::$app->request->get('IdGT');
        $usuarios = $gestorgt->ListarUsuarios($pIdGT);
        $dataProvider = new ArrayDataProvider([
              'allModels' => $usuarios,
              'pagination' => ['pagesize' => 5,],
        ]);
        return $this->render('/usuarios/listar',['dataProvider' => $dataProvider, 'listaData' => $listDataR]);   
    }
    
    public function actionAlta()
    {
        $model = new GruposTrabajo;
        $gestor = new GestorGruposTrabajo;
        
        if($model->load(Yii::$app->request->post()))// && $model->validate())
        {
            $pGrupoTrabajo = $model->GrupoTrabajo;
            $pMail = $model->Mail;
            $mensaje = $gestor->Alta($pGrupoTrabajo, $pMail);

            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->renderAjax('alta',['model' => $model]);
            }
        }
        else{
            return $this->renderAjax('alta',['model' => $model]);
        }
    }
    
    public function actionModificar()
    {
        $model = new GruposTrabajo;
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        if($model->load(Yii::$app->request->post()))// && ($model->validate()))
        {
            $pGrupoTrabajo = $model->GrupoTrabajo;
            $pMail = $model->Mail;
            $mensaje = $gestor->Modificar($pIdGT, $pGrupoTrabajo, $pMail);
            if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
            {
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
                return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
            }
            else{
                Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);            
                return $this->renderAjax('modificar',['model' => $model]);
            }
        }
        else{
            return $this->renderAjax('modificar',['model' => $model]);
        }
    }
    
    public function actionBorrar()
    {
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $mensaje = $gestor->Borrar($pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        
    }

    public function actionBaja()
    {
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $mensaje = $gestor->Baja($pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
    }
    
    public function actionActivar()
    {
        $gestor = new GestorGruposTrabajo;
        $pIdGT = Yii::$app->request->get('IdGT');
        $mensaje = $gestor->Activar($pIdGT);
        if(substr($mensaje[0]['Mensaje'], 0, 2) === 'OK')
        {
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
        else{
            Yii::$app->session->setFlash('alert',$mensaje[0]['Mensaje']);
            return $this->redirect('/sgpoc/backend/web/grupos-trabajo/listar');
        }
    }
    
}
