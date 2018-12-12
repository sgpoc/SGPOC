<?php

namespace app\models;

use Yii;


class GestorProveedores 
{
    public function Listar($pIdGT) {
        $sql = 'CALL ssp_listar_proveedores(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        $proveedores = $comando->queryAll();
        return $proveedores;
    } 
    
     public function Buscar($pProveedor, $pDomicilio, $pEmail, $pEstado, $pIdGT){
        $sql = 'CALL ssp_buscar_proveedor(:pProveedor, :pDomicilio, :pEmail, :pEstado, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pProveedor', $pProveedor)
                ->bindValue('pDomicilio',$pDomicilio)
                ->bindValue('pEmail', $pEmail)
                ->bindValue('pEstado', $pEstado)
                ->bindValue('pIdGT', $pIdGT);
        $proveedores = $comando->queryAll();
        return $proveedores;
    }
    
    public function Alta($pProveedor, $pDomicilio, $pCodigoPostal, $pEmail, $pTelefono, $pPaginaWeb, $pIdGT)
    {
        $sql = 'CALL ssp_alta_proveedor(:pProveedor, :pDomicilio, :pCodigoPostal, :pEmail, :pTelefono, :pPaginaWeb, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pProveedor', $pProveedor)
                ->bindValue('pDomicilio',$pDomicilio)
                ->bindValue('pCodigoPostal', $pCodigoPostal)
                ->bindValue('pEmail', $pEmail)
                ->bindValue('pTelefono', $pTelefono)
                ->bindValue('pPaginaWeb', $pPaginaWeb)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdProveedor, $pIdGT, $pProveedor, $pDomicilio, $pCodigoPostal, $pEmail, $pTelefono, $pPaginaWeb)
    {
        $sql = 'CALL ssp_modificar_proveedor(:pIdProveedor, :pIdGT, :pProveedor, :pDomicilio, :pCodigoPostal, :pEmail, :pTelefono, :pPaginaWeb)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pProveedor', $pProveedor)
                ->bindValue('pDomicilio',$pDomicilio)
                ->bindValue('pCodigoPostal', $pCodigoPostal)
                ->bindValue('pEmail', $pEmail)
                ->bindValue('pTelefono', $pTelefono)
                ->bindValue('pPaginaWeb', $pPaginaWeb);           
        return $comando->queryAll();
    }
    
    public function Borrar($pIdProveedor, $pIdGT)
    {
        $sql = 'CALL ssp_borrar_proveedor(:pIdProveedor, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Baja($pIdProveedor, $pIdGT)
    {
        $sql = 'CALL ssp_baja_proveedor(:pIdProveedor, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Activar($pIdProveedor, $pIdGT)
    {
        $sql = 'CALL ssp_activar_proveedor(:pIdProveedor, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Dame($pIdProveedor, $pIdGT)
    {
        $sql = 'CALL ssp_dame_proveedor(:pIdProveedor, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function ListarLocalidades($pIdProveedor, $pIdGT)
    {
        $sql = 'CALL ssp_listar_localidades_proveedor(:pIdProveedor, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
}