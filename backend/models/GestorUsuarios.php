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
    
    public function ListarRoles()
    {       
        $sql = 'CALL ssp_listar_roles()';
        $comando = Yii::$app->db->createCommand($sql);
        $roles = $comando->queryAll();
        return $roles;
    }
    
    public function Buscar($pCadena,$pIncluyeBajas){
        $sql = 'CALL ssp_buscar_usuario(:pCadena, :pIncluyeBajas)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pCadena', $pCadena)
                ->bindValue('pIncluyeBajas',$pIncluyeBajas);
        $usuarios = $comando->queryAll();
        return $usuarios;
    }
    
    public function Alta($pIdGT, $pIdRol, $pNombre, $pApellido, $pEmail, $pPassword, $pauth_key)
    {
        $sql = 'CALL ssp_alta_usuario(:pIdGT, :pIdRol, :pNombre, :pApellido, :pEmail, :pPassword, :pauth_key)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdGT', $pIdGT)
                 ->bindValue('pIdRol',$pIdRol)
                 ->bindValue('pNombre', $pNombre)
                 ->bindValue('pApellido', $pApellido)
                 ->bindValue('pEmail', $pEmail)
                 ->bindValue('pPassword', $pPassword)
                 ->bindValue('pauth_key', $pauth_key);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdUsuario, $pNombre, $pApellido, $pEmail, $pPassword)
    {
        $sql = 'CALL ssp_modificar_usuario(:pIdUsuario, :pNombre, :pApellido, :pEmail, :pPassword)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdUsuario', $pIdUsuario)
                 ->bindValue('pNombre', $pNombre)
                 ->bindValue('pApellido', $pApellido)
                 ->bindValue('pEmail', $pEmail)
                 ->bindValue('pPassword', $pPassword);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdUsuario)
    {
        $sql = 'CALL ssp_borrar_usuario(:pIdUsuario)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdUsuario', $pIdUsuario);
        return $comando->queryAll();
    }
    
    public function Baja($pIdUsuario)
    {
        $sql = 'CALL ssp_baja_usuario(:pIdUsuario)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdUsuario', $pIdUsuario);
        return $comando->queryAll();
    }
    
    public function Activar($pIdUsuario)
    {
        $sql = 'CALL ssp_activar_usuario(:pIdUsuario)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdUsuario', $pIdUsuario);
        return $comando->queryAll();
    }
}
