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
    
    public function ListarSubfamilias($pIdFamilia)
    {   
        $sql = 'CALL ssp_listar_subfamiliasfamilia(:pIdFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdFamilia', $pIdFamilia);
        $subfamilias = $comando->queryAll();
        return $subfamilias;
    }
    
    public function Buscar($pCadena){
        $sql = 'CALL ssp_buscar_familia(:pCadena)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pCadena', $pCadena);
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
    
    public function Modificar($pIdFamilia, $pFamilia)
    {
        $sql = 'CALL ssp_modificar_familia(:pIdFamilia, :pFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                 ->bindValue('pIdFamilia', $pIdFamilia)
                 ->bindValue('pFamilia', $pFamilia);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdFamilia)
    {
        $sql = 'CALL ssp_borrar_familia(:pIdFamilia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdFamilia', $pIdFamilia);
        return $comando->queryAll();
    }

}
