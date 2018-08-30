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
    
    public function AgregarInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pPrecioLista, $pFechaUltimaActualizacion)
    {
        $sql = 'CALL ssp_agregar_insumo_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdInsumo, :pPrecioLista, :pFechaUltimaActualizacion)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdInsumo',$pIdInsumo)
                ->bindValue('pPrecioLista',$pPrecioLista)
                ->bindValue('pFechaUltimaActualizacion',$pFechaUltimaActualizacion);
        return $comando->queryAll();
    }
    
    public function BorrarInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo)
    {
        $sql = 'CALL ssp_borrar_insumo_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdInsumo)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdInsumo',$pIdInsumo);
        return $comando->queryAll();
    }
    
    public function ModificarInsumo($pIdProveedor, $pIdLocalidad, $pIdInsumo, $pPrecioLista, $pFechaUltimaActualizacion)
    {
        $sql = 'CALL ssp_modificar_insumo_listaprecios(:pIdProveedor, :pIdLocalidad, :pIdInsumo, :pPrecioLista, :pFechaUltimaActualizacion)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pIdInsumo',$pIdInsumo)
                ->bindValue('pPrecioLista',$pPrecioLista)
                ->bindValue('pFechaUltimaActualizacion',$pFechaUltimaActualizacion);
        return $comando->queryAll();
    }
}
