<?php

namespace app\models;

use Yii;

class GestorSubFamilias 
{
    public function Listar($pIdGT)
    {       
        $sql = 'CALL ssp_listar_subfamilias(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        $subfamilias = $comando->queryAll();
        return $subfamilias;
    }
    
     public function ListarInsumos($pIdSubFamilia)
    {       
        $sql = 'CALL ssp_listar_insumossubfamilia(:pIdSubFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdSubFamilia', $pIdSubFamilia);
        $subfamilias = $comando->queryAll();
        return $subfamilias;
    }
 
    
    public function Buscar($pSubFamilia, $pIdFamilia, $pIdGT){
        $sql = 'CALL ssp_buscar_subfamilia(:pSubFamilia, :pIdFamilia, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pSubFamilia', $pSubFamilia)
                ->bindValue('pIdFamilia', $pIdFamilia)
                ->bindValue('pIdGT', $pIdGT);
        $subfamilia = $comando->queryAll();
        return $subfamilia;
    }
    
    public function Alta($pIdFamilia, $pSubFamilia)
    {
        $sql = 'CALL ssp_alta_subfamilia(:pIdFamilia, :pSubFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdFamilia', $pIdFamilia)
                 ->bindValue('pSubFamilia',$pSubFamilia);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdSubFamilia, $pSubFamilia)
    {
        $sql = 'CALL ssp_modificar_subfamilia(:pIdSubFamilia, :pSubFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdSubFamilia', $pIdSubFamilia)
                 ->bindValue('pSubFamilia', $pSubFamilia);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdSubFamilia)
    {
        $sql = 'CALL ssp_borrar_subfamilia(:pIdSubFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdSubFamilia', $pIdSubFamilia);
        return $comando->queryAll();
    }
    
    public function Dame($pIdSubFamilia)
    {
        $sql = 'CALL ssp_dame_subfamilia(:pIdSubFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdSubFamilia', $pIdSubFamilia);
        return $comando->queryAll();
    }
    
    public function DameSubFamiliasConFamilia($pIdGT)
    {       
        $sql = 'SELECT Familia,SubFamilia FROM familias f
                JOIN subfamilias sf ON f.IdGT = sf.IdGT';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
       return $comando->queryAll();
    }
}

