<?php
namespace app\models;

use Yii;

class GestorItems
{
    public function Listar($pIdGT)
    {       
        $sql = 'CALL ssp_listar_items(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        $items = $comando->queryAll();
        return $items;
    } 
    
    public function ListarInsumos($pIdItem, $pIdGT)
    {       
        $sql = 'CALL ssp_listar_insumos_item(:pIdItem, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdGT', $pIdGT);
        $insumos = $comando->queryAll();
        return $insumos;
    }  
    
    public function ListarRubrosItem()
    {       
        $sql = 'CALL ssp_listar_rubros_item()';
        $comando = Yii::$app->db->createCommand($sql);
        $rubrositem = $comando->queryAll();
        return $rubrositem;
    }
    
    public function Buscar($pItem, $pIdRubroItem, $pIdUnidad, $pIdGT){
        $sql = 'CALL ssp_buscar_items(:pItem, :pIdRubroItem, :pIdUnidad, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pItem', $pItem)
                ->bindValue('pIdRubroItem',$pIdRubroItem)
                ->bindValue('pIdUnidad', $pIdUnidad)
                ->bindValue('pIdGT', $pIdGT);
        $items = $comando->queryAll();
        return $items;
    }
    
    public function Alta($pItem, $pIdRubroItem, $pIdUnidad, $pIdGT)
    {
        $sql = 'CALL ssp_alta_item(:pItem, :pIdRubroItem, :pIdUnidad, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pItem', $pItem)
                ->bindValue('pIdRubroItem',$pIdRubroItem)
                ->bindValue('pIdUnidad', $pIdUnidad)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdItem, $pIdGT, $pItem)
    {
        $sql = 'CALL ssp_modificar_item(:pIdItem, :pIdGT, :pItem)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdGT',$pIdGT)
                ->bindValue('pItem',$pItem);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdItem, $pIdGT)
    {
        $sql = 'CALL ssp_borrar_item(:pIdItem, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Dame($pIdItem, $pIdGT)
    {
        $sql = 'CALL ssp_dame_item(:pIdItem, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
   
    public function AgregarInsumo($pIdItem, $pIdInsumo, $pIdGT, $pIncidencia)
    {
        $sql = 'CALL ssp_agregar_insumo_item(:pIdItem, :pIdInsumo, :pIdGT, :pIncidencia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdInsumo',$pIdInsumo)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pIncidencia',$pIncidencia);
        return $comando->queryAll();
    }
    
    public function ModificarIncidencia($pIdItem, $pIdInsumo, $pIdGT, $pIncidencia)
    {
        $sql = 'CALL ssp_modificar_incidencia_insumo(:pIdItem, :pIdInsumo, :pIdGT, :pIncidencia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdInsumo',$pIdInsumo)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pIncidencia',$pIncidencia);
        return $comando->queryAll();
    }
    
    public function BorrarInsumo($pIdItem, $pIdInsumo, $pIdGT)
    {
        $sql = 'CALL ssp_borrar_insumo_item(:pIdItem, :pIdInsumo, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdInsumo',$pIdInsumo)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function DameIncidenciaInsumoItem($pIdItem, $pIdInsumo, $pIdGT)
    {
        $sql = 'CALL ssp_dame_incidencia_insumo_item(:pIdItem, :pIdInsumo, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdInsumo', $pIdInsumo)
                ->bindValue('pIdGT', $pIdGT);
                
        return $comando->queryAll();
    }

    public function dameUnidadItem($pIdItem){
        $sql = 'CALL ssp_dame_incidencia_insumo_item(:pIdItem, :pIdInsumo)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem);
           
                
        return $comando->queryAll();
    }

    public function DameRubroItemUnidad($pIdItem,$pIdGT){
        $sql = 'SELECT Item,RubroItem,Abreviatura FROM Items i
        JOIN Unidades u ON i.IdUnidad = u.Idunidad
        JOIN RubrosItem ri ON i.IdRubroItem = ri.IdRubroItem
        WHERE i.IdItem = :pIdItem AND i.IdGT = :pIdGT';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
}
