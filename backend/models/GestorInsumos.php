<?php
namespace app\models;

use Yii;

class GestorInsumos
{
    public function Listar()
    {       
        $sql = 'CALL ssp_listar_insumos()';
        $comando = Yii::$app->db->createCommand($sql);
        $insumos = $comando->queryAll();
        return $insumos;
    }
    
    public function ListarUnidades()
    {       
        $sql = 'CALL ssp_listar_unidades()';
        $comando = Yii::$app->db->createCommand($sql);
        $unidades = $comando->queryAll();
        return $unidades;
    }

    public function Buscar($pInsumo, $pTipoInsumo, $pIdFamilia, $pIdSubFamilia, $pIdUnidad){
        $sql = 'CALL ssp_buscar_insumos(:pInsumo, :pTipoInsumo, :pFamilia, :pIdSubFamilia, :pIdUnidad)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pInsumo', $pInsumo)
                ->bindValue('pTipoInsumo', $pTipoInsumo)
                ->bindValue('pIdFamilia',$pIdFamilia)
                ->bindValue('pIdSubFamilia',$pIdSubFamilia)
                ->bindValue('pIdUnidad',$pIdUnidad);
        $insumos = $comando->queryAll();
        return $insumos;
    }
    
    public function Alta($pInsumo, $pTipoInsumo, $pIdSubFamilia, $pIdUnidad)
    {
        $sql = 'CALL ssp_alta_insumo(:pInsumo, :pTipoInsumo, :pIdSubFamilia, :pIdUnidad)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pInsumo', $pInsumo)
                ->bindValue('pTipoInsumo', $pTipoInsumo)
                ->bindValue('pIdSubFamilia', $pIdSubFamilia)
                ->bindValue('pIdUnidad', $pIdUnidad);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdInsumo, $pInsumo, $pTipoInsumo)
    {
        $sql = 'CALL ssp_modificar_insumo(:pIdInsumo, :pInsumo, :pTipoInsumo)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdInsumo', $pIdInsumo)
                ->bindValue('pInsumo', $pInsumo)
                ->bindValue('pTipoInsumo', $pTipoInsumo);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdInsumo)
    {
        $sql = 'CALL ssp_borrar_insumo(:pIdInsumo)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdInsumo', $pIdInsumo);
        return $comando->queryAll();
    }

}
