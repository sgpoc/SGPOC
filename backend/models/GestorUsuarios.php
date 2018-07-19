<?php
namespace app\models;

use Yii;

class GestorUsuarios 
{
    public function Listar()
    {       
        $sql = 'CALL ssp_listar_usuarios()';
        $comando = Yii::$app->db->createCommand($sql);
        $usuarios = $comando->queryAll();
        return $usuarios;
    }
    
    public function Buscar($pCadena,$pIncluyeBajas){
        $sql = 'CALL ssp_buscar_usuario(:pCadena, :pIncluyeBajas)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pCadena', $pCadena)
                ->bindValue('pIncluyeBajas',$pIncluyeBajas);
        $usuarios = $comando->queryAll();
        return $usuarios;
    }
    
    public function Alta($pIdGT, $pNombre, $pApellido, $pRol, $pEmail, $pPassword)
    {
        $sql = 'CALL ssp_alta_usuario(:pIdGT, :pNombre, :pApellido, :pRol, :pEmail, :pPassword)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdGT', $pIdGT)
                 ->bindValue('pNombre', $pNombre)
                 ->bindValue('pApellido', $pApellido)
                 ->bindValue('pRol', $pRol)
                 ->bindValue('pEmail', $pEmail)
                 ->bindValue('pPassword', $pPassword);
        return $comando->execute();
    }
    
    public function Modificar($pIdUsuario, $pNombre, $pApellido, $pRol, $pEmail, $pPassword)
    {
        $sql = 'CALL ssp_modificar_usuario(:pIdUsuario, :pNombre, :pApellido, :pRol, :pEmail, :pPassword)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdUsuario', $pIdUsuario)
                 ->bindValue('pNombre', $pNombre)
                 ->bindValue('pApellido', $pApellido)
                 ->bindValue('pRol', $pRol)
                 ->bindValue('pEmail', $pEmail)
                 ->bindValue('pPassword', $pPassword);
        return $comando->execute();
    }
    
    public function Borrar($pIdUsuario)
    {
        $sql = 'CALL ssp_borrar_usuario(:pIdUsuario)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdUsuario', $pIdUsuario);
        return $comando->execute();
    }
    
    public function Baja($pIdUsuario)
    {
        $sql = 'CALL ssp_baja_usuario(:pIdUsuario)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdUsuario', $pIdUsuario);
        return $comando->execute();
    }
    
    public function Activar($pIdUsuario)
    {
        $sql = 'CALL ssp_activar_usuario(:pIdUsuario)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdUsuario', $pIdUsuario);
        return $comando->execute();
    }
}
