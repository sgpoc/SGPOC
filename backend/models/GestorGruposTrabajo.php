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
    //bla
    public function Buscar($pCadena,$pIncluyeBajas){
        $sql = 'CALL ssp_buscar_grupotrabajo(:pCadena, :pIncluyeBajas)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pCadena', $pCadena)
                ->bindValue('pIncluyeBajas',$pIncluyeBajas);
        $grupostrabajo = $comando->queryAll();
        return $grupostrabajo;
    }
    
    public function Alta($pGrupoTrabajo, $pMail, $pPassword)
    {
        $sql = 'CALL ssp_alta_grupotrabajo(:pGrupoTrabajo, :pMail, :pPassword)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pGrupoTrabajo', $pGrupoTrabajo)
                 ->bindValue('pMail', $pMail)
                 ->bindValue('pPassword', $pPassword);
        return $comando->execute();
    }
    
    public function Modificar($pIdGT, $pGrupoTrabajo, $pMail, $pPassword)
    {
        $sql = 'CALL ssp_modificar_grupotrabajo(:pIdGT, :pGrupoTrabajo, :pMail, :pPassword)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdGT', $pIdGT)
                 ->bindValue('pGrupoTrabajo', $pGrupoTrabajo)
                 ->bindValue('pMail', $pMail)
                 ->bindValue('pPassword', $pPassword);
        return $comando->execute();
    }
    
    public function Borrar($pIdGT)
    {
        $sql = 'CALL ssp_borrar_grupotrabajo(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->execute();
    }
    
    public function Baja($pIdGT)
    {
        $sql = 'CALL ssp_baja_grupotrabajo(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT',$pIdGT);
        return $comando->execute();
    }
    
    public function Activar($pIdGT)
    {
        $sql = 'CALL ssp_activar_grupotrabajo(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT',$pIdGT);
        return $comando->execute();
    }
}
