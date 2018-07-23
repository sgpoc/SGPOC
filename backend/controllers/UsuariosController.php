<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use app\models\GestorGruposTrabajo;
use app\models\GestorUsuarios;
use app\models\Usuarios;
use app\models\UsuariosBuscar;


class UsuariosController extends Controller
{
    public function actionIndex()
    {
        
    }
    
    public function actionListar()
    {       
        $gestor = new GestorUsuarios;
        $usuarios = $gestor->Listar();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $usuarios,
            'pagination' => ['pagesize' => 10,],
        ]);
        return $this->render('listar',['dataProvider' => $dataProvider]);
    }
    
    public function actionBuscar()
    {
        $model = new UsuariosBuscar;
        $gestor = new GestorUsuarios;
    
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $pCadena = $model->pCadena;
            $pIncluyeBajas = $model->pIncluyeBajas;
            $usuarios = $gestor->Buscar($pCadena, $pIncluyeBajas);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $usuarios,
                'pagination' => ['pagesize' => 10,],
            ]);
            return $this->render('listar',['dataProvider' => $dataProvider]);
        }
        else
        {
            return $this->render('buscar',['model' => $model]);
        }
    }
    
    
    public function actionAlta()
    {
        $model = new Usuarios;
        $gestoru = new GestorUsuarios;
        $gestorgt = new GestorGruposTrabajo;
        $gestor = new GestorUsuarios;
        $grupostrabajo = $gestorgt->Listar();
        $listData= ArrayHelper::map($grupostrabajo,'IdGT','GrupoTrabajo');
        $roles = $gestoru->ListarRoles();
        $listDataU = ArrayHelper::map($roles,'IdRol','Rol');
        
        if($model->load(Yii::$app->request->post())) //&& $model->validate())
        {
            $pIdGT = $model->IdGT;
            $pIdRol = $model->IdRol;
            $pNombre = $model->Nombre;
            $pApellido = $model->Apellido;
            $pEmail = $model->Email;
            $pPassword = $model->Password;
            $mensaje = $gestor->Alta($pIdGT, $pIdRol, $pNombre, $pApellido, $pEmail, $pPassword);
            return $this->redirect('/sgpoc/backend/web/usuarios/listar');
            
        }
        else{
            return $this->render('alta',['model' => $model, 'listData' => $listData, 'listDataU' => $listDataU]);
        }
    }
    
    public function actionModificar()
    {
        $model = new Usuarios;
        $gestor = new GestorUsuarios;
        $pIdUsuario = Yii::$app->request->get('IdUsuario');
        if($model->load(Yii::$app->request->post()))// && ($model->validate()))
        {
            $pNombre = $model->Nombre;
            $pApellido = $model->Apellido;
            $pEmail = $model->Email;
            $pPassword = $model->Password;
            $mensaje = $gestor->Modificar($pIdUsuario, $pNombre, $pApellido, $pEmail, $pPassword);
            return $this->redirect('/sgpoc/backend/web/usuarios/listar');
             
        }
        else{
           return $this->render('modificar',['model' => $model]);
        }
    }
    
    public function actionBorrar()
    {
        $gestor = new GestorUsuarios;
        $pIdUsuario = Yii::$app->request->get('IdUsuario');
        $gestor->Borrar($pIdUsuario);
        return $this->redirect('/sgpoc/backend/web/usuarios/listar');
    }

    public function actionBaja()
    {
        $gestor = new GestorUsuarios;
        $pIdUsuario = Yii::$app->request->get('IdUsuario');
        $gestor->Baja($pIdUsuario);
        return $this->redirect('/sgpoc/backend/web/usuarios/listar');
    }
    
    public function actionActivar()
    {
        $gestor = new GestorUsuarios;
        $pIdUsuario = Yii::$app->request->get('IdUsuario');
        $gestor->Activar($pIdUsuario);
        return $this->redirect('/sgpoc/backend/web/usuarios/listar');
    }
    
}
