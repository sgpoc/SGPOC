<?php

namespace app\models;

use Yii;


class GestorProveedores 
{
    public function Listar() {
        $sql = 'CALL ssp_listar_proveedores';
        $comando = Yii::$app->db->createCommand($sql);
        $proveedores = $comando->queryAll();
        return $proveedores;
    } 
    
     public function Buscar($pProveedor, $pDomicilio, $pEmail, $pEstado){
        $sql = 'CALL ssp_buscar_proveedor(:pProveedor, :pDomicilio, :pEmail, :pEstado)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pProveedor', $pProveedor)
                ->bindValue('pDomicilio',$pDomicilio)
                ->bindValue('pEmail', $pEmail)
                ->bindValue('pEstado', $pEstado);
        $proveedores = $comando->queryAll();
        return $proveedores;
    }
    
    public function Alta($pProveedor, $pDomicilio, $pCodigoPostal, $pEmail, $pTelefono, $pPaginaWeb)
    {
        $sql = 'CALL ssp_alta_proveedor(:pProveedor, :pDomicilio, :pCodigoPostal, :pEmail, :pTelefono, :pPaginaWeb)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pProveedor', $pProveedor)
                ->bindValue('pDomicilio',$pDomicilio)
                ->bindValue('pCodigoPostal', $pCodigoPostal)
                ->bindValue('pEmail', $pEmail)
                ->bindValue('pTelefono', $pTelefono)
                ->bindValue('pPaginaWeb', $pPaginaWeb);
                
        return $comando->queryAll();
    }
    
    public function Modificar($pIdProveedor,$pProveedor, $pDomicilio, $pCodigoPostal, $pEmail, $pTelefono, $pPaginaWeb)
    {
        $sql = 'CALL ssp_modificar_proveedor(:pIdProveedor, :pProveedor, :pDomicilio, :pCodigoPostal, :pEmail, :pTelefono, :pPaginaWeb)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor) 
                ->bindValue('pProveedor', $pProveedor)
                ->bindValue('pDomicilio',$pDomicilio)
                ->bindValue('pCodigoPostal', $pCodigoPostal)
                ->bindValue('pEmail', $pEmail)
                ->bindValue('pTelefono', $pTelefono)
                ->bindValue('pPaginaWeb', $pPaginaWeb);
                
        return $comando->queryAll();
    }
    
    public function Borrar($pIdProveedor)
    {
        $sql = 'CALL ssp_borrar_proveedor(:pIdProveedor)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor);
        return $comando->queryAll();
    }
    
    public function Baja($pIdProveedor)
    {
        $sql = 'CALL ssp_baja_proveedor(:pIdProveedor)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor);
        return $comando->queryAll();
    }
    
    public function Activar($pIdProveedor)
    {
        $sql = 'CALL ssp_activar_proveedor(:pIdProveedor)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor);
        return $comando->queryAll();
    }
    
    public function Dame($pIdProveedor)
    {
        $sql = 'CALL ssp_dame_proveedor(:pIdProveedor)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor);
        return $comando->queryAll();
    }
        
    
    

}