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
    
    public function Alta($pIdComputoMetrico, $pIdObra, $pIdLocalidad, $pFechaDePresupuesto)
    {
        $sql = 'CALL ssp_alta_presupuesto(:pIdComputoMetrico, :pIdObra, :pIdLocalidad, :pFechaDePresupuesto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdComputoMetrico', $pIdComputoMetrico)
                ->bindValue('pIdObra', $pIdObra)
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
    
    public function ListarItems($pIdPresupuesto)
    {   
        $sql = 'CALL ssp_listar_items_presupuesto(:pIdPresupuesto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto);
        $items = $comando->queryAll();
        return $items;
    }
    
    public function ListarElementos($pIdPresupuesto)
    {   
        $sql = 'CALL ssp_listar_elementos_presupuesto(:pIdPresupuesto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto);
        $elementos = $comando->queryAll();
        return $elementos;
    }
    
    public function ListarInsumos($pIdPresupuesto)
    {   
        $sql = 'CALL ssp_listar_insumos_presupuesto(:pIdPresupuesto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto);
        $insumos = $comando->queryAll();
        return $insumos;
    }
    
    public function DameLinea($pIdPresupuesto, $pIdInsumo)
    {
        $sql = 'CALL ssp_dame_linea_presupuesto(:pIdPresupuesto, :pIdInsumo)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto)
                ->bindValue('pIdInsumo', $pIdInsumo);
        return $comando->queryAll();
    }
    
    public function ModificarPorcentajes($pIdPresupuesto, $pIdInsumo, $pBeneficios, $pGastosGenerales, $pCargasSociales, $pIVA)
    {
        $sql = 'CALL ssp_modificar_porcentajes_linea(:pIdPresupuesto, :pIdInsumo, :pBeneficios, :pGastosGenerales, :pCargasSociales, :pIVA)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto)
                ->bindValue('pIdInsumo', $pIdInsumo)
                ->bindValue('pBeneficios', $pBeneficios)
                ->bindValue('pGastosGenerales', $pGastosGenerales)
                ->bindValue('pCargasSociales', $pCargasSociales)
                ->bindValue('pIVA', $pIVA);
        return $comando->queryAll();
    }
    
    public function EleccionPrecio($pIdPresupuesto, $pIdInsumo, $pIdProveedor, $pIdLocalidad)
    {
        $sql = 'CALL ssp_eleccion_precio_linea(:pIdPresupuesto, :pIdInsumo, :pIdProveedor, :pIdLocalidad)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto)
                ->bindValue('pIdInsumo', $pIdInsumo)
                ->bindValue('pIdProveedor', $pIdProveedor)
                ->bindValue('pIdLocalidad', $pIdLocalidad);
        return $comando->queryAll();
    }
    
    public function CalculoPrecioTotal($pIdPresupuesto)
    {
        $sql = 'CALL ssp_calculo_precio_total(:pIdPresupuesto)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdPresupuesto', $pIdPresupuesto);
        $preciototal = $comando->queryAll();
        return $preciototal;
    }

    public function DamePresupuestoExportar($pIdPresupuesto,$pIdGT){
        $sql = 'CALL dame_precio_final_presupuesto(:pIdPresupuesto,:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
        ->bindValue('pIdPresupuesto', $pIdPresupuesto)
        ->bindValue('pIdGT', $pIdGT);
     return  $comando->queryAll();
    }
    
}
