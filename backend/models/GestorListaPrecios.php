<?php
namespace app\models;

use Yii;

class GestorListaPrecios
{
    public function Listar($pIdGT)
    {       
        $sql = 'CALL ssp_listar_listasprecio(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        $listaprecios = $comando->queryAll();
        return $listaprecios;
    }
    
    public function ListarLocalidades()
    {       
        $sql = 'CALL ssp_listar_localidades()';
        $comando = Yii::$app->db->createCommand($sql);
        $localidades = $comando->queryAll();
        return $localidades;
    } 
    
    public function ListarInsumos($pIdProveedor, $pIdLocalidad, $pIdGT)
    {       
        $sql = 'CALL ssp_listar_insumos_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdGT', $pIdGT);
        $insumos = $comando->queryAll();
        return $insumos;
    }  
    
    public function Buscar($pIdProveedor, $pIdLocalidad, $pIdGT){
        $sql = 'CALL ssp_buscar_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad',$pIdLocalidad)
                ->bindValue('pIdGT', $pIdGT);
        $obras = $comando->queryAll();
        return $obras;
    }
    
    public function Alta($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pPrecioLista, $pFechaUltimaActualizacion, $pIdGT)
    {
        $sql = 'CALL ssp_alta_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdInsumo, :pPrecioLista, :pFechaUltimaActualizacion, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor',$pIdProveedor)
                ->bindValue('pIdLocalidad',$pIdLocalidad)
                ->bindValue('pIdInsumo', $pIdInsumo)
                ->bindValue('pPrecioLista', $pPrecioLista)
                ->bindValue('pFechaUltimaActualizacion', $pFechaUltimaActualizacion)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdProveedor, $pIdLocalidad, $pIdGT) 
    {
        $sql = 'CALL ssp_borrar_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();    
    }
    
    public function AgregarInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pIdGT, $pPrecioLista, $pFechaUltimaActualizacion)
    {
        $sql = 'CALL ssp_agregar_insumo_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdInsumo, :pIdGT, :pPrecioLista, :pFechaUltimaActualizacion)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdInsumo',$pIdInsumo)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pPrecioLista',$pPrecioLista)
                ->bindValue('pFechaUltimaActualizacion',$pFechaUltimaActualizacion);
        return $comando->queryAll();
    }
    
    public function BorrarInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pIdGT)
    {
        $sql = 'CALL ssp_borrar_insumo_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdInsumo)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdInsumo',$pIdInsumo)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function ModificarInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pIdGT, $pPrecioLista, $pFechaUltimaActualizacion)
    {
        $sql = 'CALL ssp_modificar_insumo_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdInsumo, :pIdGT, :pPrecioLista, :pFechaUltimaActualizacion)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdInsumo',$pIdInsumo)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pPrecioLista',$pPrecioLista)
                ->bindValue('pFechaUltimaActualizacion',$pFechaUltimaActualizacion);
        return $comando->queryAll();
    }
      
    public function DamePrecioFechaInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pIdGT)
    {
        $sql = 'CALL ssp_dame_precio_fecha_insumo(:pIdProveedor, :pIdLocalidad, :pIdInsumo, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdInsumo', $pIdInsumo)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }

    public function ListaExportar($pIdGT, $pIdProveedor, $pIdLocalidad)
    {       
        $sql = 'SELECT Proveedor,Localidad FROM Proveedores p
                JOIN listaprecios lp ON lp.IdProveedor = p.IdProveedor
                JOIN localidades l ON l.IdLocalidad = lp.Idlocalidad
                WHERE p.IdProveedor = :pIdProveedor AND p.IdGT = :pIdGT AND lp.IdLocalidad = :pIdLocalidad
                LIMIT 1';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }  
   
}
