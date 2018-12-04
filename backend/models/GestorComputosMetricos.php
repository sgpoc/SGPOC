<?php
namespace app\models;

use Yii;

class GestorComputosMetricos
{
    public function Listar($pIdGT)
    {       
        $sql = 'CALL ssp_listar_computosmetricos(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        $computos = $comando->queryAll();
        return $computos;
    }
    
    public function ListarItems($pIdComputoMetrico, $pIdGT)
    {   
        $sql = 'CALL ssp_listar_items_computo(:pIdComputoMetrico, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pIdGT', $pIdGT);
        $items = $comando->queryAll();
        return $items;
    }
    
    public function ListarElementos($pIdComputoMetrico, $pIdGT)
    {   
        $sql = 'CALL ssp_listar_elementos_computo(:pIdComputoMetrico, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pIdGT', $pIdGT);
        $elementos = $comando->queryAll();
        return $elementos;
    }
    
    public function Buscar($pIdObra, $pDescripcion, $pFechaComputoMetrico, $pIdGT){
        $sql = 'CALL ssp_buscar_computosmetricos(:pIdObra, :pDescripcion, :pFechaComputoMetrico, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra)
                ->bindValue('pDescripcion', $pDescripcion)
                ->bindValue('pFechaComputoMetrico',$pFechaComputoMetrico)
                ->bindValue('pIdGT', $pIdGT);
        $computos = $comando->queryAll();
        return $computos;
    }
    
    public function Alta($pIdObra, $pDescripcion, $pFechaComputoMetrico, $pTipoComputo)
    {
        $sql = 'CALL ssp_alta_computometrico(:pIdObra, :pDescripcion, :pFechaComputoMetrico, :pTipoComputo)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra)
                ->bindValue('pDescripcion', $pDescripcion)
                ->bindValue('pFechaComputoMetrico',$pFechaComputoMetrico)
                ->bindValue('pTipoComputo', $pTipoComputo);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdComputoMetrico, $pDescripcion, $pFechaComputoMetrico, $pTipoComputo)
    {
        $sql = 'CALL ssp_modificar_computometrico(:pIdComputoMetrico, :pDescripcion, :pFechaComputoMetrico, :pTipoComputo)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pDescripcion', $pDescripcion)
                ->bindValue('pFechaComputoMetrico', $pFechaComputoMetrico)
                ->bindValue('pTipoComputo',$pTipoComputo);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdComputoMetrico)
    {
        $sql = 'CALL ssp_borrar_computometrico(:pIdComputoMetrico)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico);
        return $comando->queryAll();
    }
    
    public function Dame($pIdComputoMetrico)
    {
        $sql = 'CALL ssp_dame_computometrico(:pIdComputoMetrico)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico);
        return $comando->queryAll();
    }
    
    public function DameLinea($pIdComputoMetrico, $pNroLinea)
    {
        $sql = 'CALL ssp_dame_linea_computo(:pIdComputoMetrico, :pNroLinea)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pNroLinea', $pNroLinea);
        return $comando->queryAll();
    }
    
    public function AgregarLinea($pIdComputoMetrico, $pIdGT, $pIdElementoConstructivo, $pIdItem, $pIdUnidad, $pDescripcion, $pCantidad, $pLargo, $pAncho, $pAlto)
    {
        $sql = 'CALL ssp_agregar_linea_computo(:pIdComputoMetrico, :pIdGT, :pIdElementoConstructivo, :pIdItem, :pIdUnidad, :pDescripcion, :pCantidad, :pLargo, :pAncho, :pAlto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pIdElementoConstructivo', $pIdElementoConstructivo)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdUnidad', $pIdUnidad)
                ->bindValue('pDescripcion', $pDescripcion)
                ->bindValue('pCantidad', $pCantidad)
                ->bindValue('pLargo', $pLargo)
                ->bindValue('pAncho', $pAncho)
                ->bindValue('pAlto', $pAlto);
        return $comando->queryAll();
    }
    
    public function ModificarLinea($pIdComputoMetrico, $pNroLinea, $pDescripcion, $pCantidad, $pLargo, $pAncho, $pAlto, $pParcial)
    {
        $sql = 'CALL ssp_modificar_linea_computo(:pIdComputoMetrico, :pNroLinea, :pDescripcion, :pCantidad, :pLargo, :pAncho, :pAlto, :pParcial)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pNroLinea', $pNroLinea)
                ->bindValue('pDescripcion', $pDescripcion)
                ->bindValue('pCantidad', $pCantidad)
                ->bindValue('pLargo', $pLargo)
                ->bindValue('pAncho', $pAncho)
                ->bindValue('pAlto', $pAlto)
                ->bindValue('pParcial', $pParcial);
        return $comando->queryAll();
    }
    
    public function BorrarLinea($pIdComputoMetrico, $pNroLinea)
    {
        $sql = 'CALL ssp_borrar_linea_computo(:pIdComputoMetrico, :pNroLinea)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pNroLinea', $pNroLinea);
        return $comando->queryAll();
    }
}
