<?php
namespace app\models;

use Yii;

class GestorPresupuestos
{
    public function Listar($pIdGT)
    {       
        $sql = 'CALL ssp_listar_presupuestos(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        $presupuestos = $comando->queryAll();
        return $presupuestos;
    }
    
    public function Buscar($pIdObra, $pFechaDePresupuesto, $pIdGT){
        $sql = 'CALL ssp_buscar_presupuestos(:pIdObra, :pFechaDePresupuesto, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra)
                ->bindValue('pFechaDePresupuesto',$pFechaDePresupuesto)
                ->bindValue('pIdGT', $pIdGT);
        $presupuestos = $comando->queryAll();
        return $presupuestos;
    }
    
    public function Alta($pIdComputoMetrico, $pIdObra, $pIdProveedor, $pIdLocalidad, $pFechaDePresupuesto)
    {
        $sql = 'CALL ssp_alta_presupuesto(:pIdComputoMetrico, :pIdObra, :pIdProveedor, :pIdLocalidad, :pFechaDePresupuesto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pIdObra', $pIdObra)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
                ->bindValue('pFechaDePresupuesto',$pFechaDePresupuesto);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdPresupuesto, $pFechaDePresupuesto)
    {
        $sql = 'CALL ssp_modificar_presupuesto(:pIdPresupuesto, :pFechaDePresupuesto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto)
                ->bindValue('pFechaDePresupuesto', $pFechaDePresupuesto);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdPresupuesto)
    {
        $sql = 'CALL ssp_borrar_presupuesto(:pIdPresupuesto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto);
        return $comando->queryAll();
    }
    
    public function Dame($pIdPresupuesto)
    {
        $sql = 'CALL ssp_dame_presupuesto(:pIdPresupuesto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto);
        return $comando->queryAll();
    }
    
    public function ListarItems($pIdPresupuesto, $pIdProveedor, $pIdLocalidad, $pIdGT)
    {   
        $sql = 'CALL ssp_listar_items_presupuesto(:pIdPresupuesto, :pIdProveedor, :pIdLocalidad, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad)
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
    
    public function ListarInsumos($pIdPresupuesto, $pIdGT)
    {   
        $sql = 'CALL ssp_listar_insumos_presupuesto(:pIdPresupuesto, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto)
                ->bindValue('pIdGT', $pIdGT);
        $insumos = $comando->queryAll();
        return $insumos;
    }
    
    public function DameLinea($pIdComputoMetrico, $pNroLinea)
    {
        $sql = 'CALL ssp_dame_linea_computo(:pIdComputoMetrico, :pNroLinea)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pNroLinea', $pNroLinea);
        return $comando->queryAll();
    }
    
    public function AgregarLinea($pIdPresupuesto, $pIdGT, $pIdElementoConstructivo, $pIdItem, $pIdUnidad, $pDescripcion, $pCantidad, $pLargo, $pAncho, $pAlto)
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
    
    public function ModificarLinea($pIdComputoMetrico, $pNroLinea, $pDescripcion, $pCantidad, $pLargo, $pAncho, $pAlto)
    {
        $sql = 'CALL ssp_modificar_linea_computo(:pIdComputoMetrico, :pNroLinea, :pDescripcion, :pCantidad, :pLargo, :pAncho, :pAlto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pNroLinea', $pNroLinea)
                ->bindValue('pDescripcion', $pDescripcion)
                ->bindValue('pCantidad', $pCantidad)
                ->bindValue('pLargo', $pLargo)
                ->bindValue('pAncho', $pAncho)
                ->bindValue('pAlto', $pAlto);
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
