<?php
namespace app\models;

use Yii;

class GestorFamilias 
{
    public function Listar($pIdGT)
    {       
        $sql = 'CALL ssp_listar_familias(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT',$pIdGT);
        $familias = $comando->queryAll();
        return $familias;
    }
    
    public function ListarSubfamilias($pIdFamilia, $pIdGT)
    {   
        $sql = 'CALL ssp_listar_subfamiliasfamilia(:pIdFamilia, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdFamilia', $pIdFamilia)
                ->bindValue('pIdGT',$pIdGT);
        $subfamilias = $comando->queryAll();
        return $subfamilias;
    }
    
    public function Buscar($pFamilia, $pIdGT){
        $sql = 'CALL ssp_buscar_familia(:pFamilia, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pFamilia', $pFamilia)
                ->bindValue('pIdGT', $pIdGT);
        $familias = $comando->queryAll();
        return $familias;
    }
    
    public function Alta($pIdGT, $pFamilia)
    {
        $sql = 'CALL ssp_alta_familia(:pIdGT, :pFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdGT', $pIdGT)
                 ->bindValue('pFamilia', $pFamilia);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdFamilia, $pIdGT, $pFamilia)
    {
        $sql = 'CALL ssp_modificar_familia(:pIdFamilia, :pIdGT, :pFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdFamilia', $pIdFamilia)
                 ->bindValue('pIdGT', $pIdGT)
                 ->bindValue('pFamilia', $pFamilia);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdFamilia, $pIdGT)
    {
        $sql = 'CALL ssp_borrar_familia(:pIdFamilia, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdFamilia', $pIdFamilia)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Dame($pIdFamilia, $pIdGT)
    {
        $sql = 'CALL ssp_dame_familia(:pIdFamilia, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdFamilia', $pIdFamilia)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }

}
