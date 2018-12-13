<?php
namespace app\models;

use Yii;

class GestorInsumos
{
    public function Listar($pIdGT)
    {       
        $sql = 'CALL ssp_listar_insumos(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
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
    

    public function Buscar($pInsumo, $pTipoInsumo, $pIdFamilia, $pIdSubFamilia, $pIdUnidad, $pIdGT){
        $sql = 'CALL ssp_buscar_insumos(:pInsumo, :pTipoInsumo, :pIdFamilia, :pIdSubFamilia, :pIdUnidad, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pInsumo', $pInsumo)
                ->bindValue('pTipoInsumo', $pTipoInsumo)
                ->bindValue('pIdFamilia',$pIdFamilia)
                ->bindValue('pIdSubFamilia',$pIdSubFamilia)
                ->bindValue('pIdUnidad',$pIdUnidad)
                ->bindValue('pIdGT',$pIdGT);
        $insumos = $comando->queryAll();
        return $insumos;
    }
    
    public function Alta($pInsumo, $pIdGT, $pTipoInsumo, $pIdSubFamilia, $pIdUnidad)
    {
        $sql = 'CALL ssp_alta_insumo(:pInsumo, :pIdGT, :pTipoInsumo, :pIdSubFamilia, :pIdUnidad)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pInsumo', $pInsumo)
                ->bindValue('pIdGT',$pIdGT)
                ->bindValue('pTipoInsumo', $pTipoInsumo)
                ->bindValue('pIdSubFamilia', $pIdSubFamilia)
                ->bindValue('pIdUnidad', $pIdUnidad);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdInsumo, $pInsumo, $pTipoInsumo, $pIdSubFamilia)
    {
        $sql = 'CALL ssp_modificar_insumo(:pIdInsumo, :pInsumo, :pTipoInsumo, :pIdSubFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdInsumo', $pIdInsumo)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pInsumo', $pInsumo)
                ->bindValue('pTipoInsumo', $pTipoInsumo)
                ->bindValue('pIdSubFamilia', $pIdSubFamilia);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdInsumo, $pIdGT)
    {
        $sql = 'CALL ssp_borrar_insumo(:pIdInsumo, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdInsumo', $pIdInsumo)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Dame($pIdInsumo,$pIdGT)
    {
        $sql = 'CALL ssp_dame_insumo(:pIdInsumo,:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdInsumo', $pIdInsumo)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }

}
