<?php
namespace app\models;

use Yii;

class GestorGruposTrabajo 
{
    public function Listar()
    {       
        $sql = 'CALL ssp_listar_grupostrabajo()';
        $comando = Yii::$app->db->createCommand($sql);
        $grupostrabajo = $comando->queryAll();
        return $grupostrabajo;
    }
    
    public function ListarUsuarios($pIdGT)
    {   
        $sql = 'CALL ssp_listar_usuariosgrupostrabajo(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        $usuarios = $comando->queryAll();
        return $usuarios;
    }

    public function Buscar($pGrupoTrabajo, $pMail, $pEstado){
        $sql = 'CALL ssp_buscar_grupotrabajo(:pGrupoTrabajo, :pMail, :pEstado)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pGrupoTrabajo', $pGrupoTrabajo)
                ->bindValue('pMail', $pMail)
                ->bindValue('pEstado',$pEstado);
        $grupostrabajo = $comando->queryAll();
        return $grupostrabajo;
    }
    
    public function Alta($pGrupoTrabajo, $pMail)
    {
        $sql = 'CALL ssp_alta_grupotrabajo(:pGrupoTrabajo, :pMail)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pGrupoTrabajo', $pGrupoTrabajo)
                 ->bindValue('pMail', $pMail);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdGT, $pGrupoTrabajo, $pMail)
    {
        $sql = 'CALL ssp_modificar_grupotrabajo(:pIdGT, :pGrupoTrabajo, :pMail)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdGT', $pIdGT)
                 ->bindValue('pGrupoTrabajo', $pGrupoTrabajo)
                 ->bindValue('pMail', $pMail);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdGT)
    {
        $sql = 'CALL ssp_borrar_grupotrabajo(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Baja($pIdGT)
    {
        $sql = 'CALL ssp_baja_grupotrabajo(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT',$pIdGT);
        return $comando->queryAll();
    }
    
    public function Activar($pIdGT)
    {
        $sql = 'CALL ssp_activar_grupotrabajo(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT',$pIdGT);
        return $comando->queryAll();
    }
}
