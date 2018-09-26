<?php
namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class GestorObras
{
    public function Listar($pIdGT)
    {       
        $sql = 'CALL ssp_listar_obras(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT);
        $obras = $comando->queryAll();
        return $obras;
    }    
    
    public function ListarLocalidades()
    {       
        $sql = 'CALL ssp_listar_localidades()';
        $comando = Yii::$app->db->createCommand($sql);
        $localidades = $comando->queryAll();
        return $localidades;
    }
    
    public function ListarComputos($pIdObra)
    {
        $sql = 'CALL ssp_listar_computos_obra(:pIdObra)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra);
        $computos = $comando->queryAll();
        return $computos;
    }
    
    public function Buscar($pObra, $pIdLocalidad, $pDireccion, $pEstado, $pIdGT){
        $sql = 'CALL ssp_buscar_obras(:pObra, :pIdLocalidad, :pDireccion, :pEstado, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pObra', $pObra)
                ->bindValue('pIdLocalidad',$pIdLocalidad)
                ->bindValue('pDireccion', $pDireccion)
                ->bindValue('pEstado', $pEstado)
                ->bindValue('pIdGT', $pIdGT);
        $obras = $comando->queryAll();
        return $obras;
    }
    
    public function Alta($pIdGT, $pIdLocalidad, $pObra, $pDireccion, $pPropietario, $pTelefono, $pEmail, $pComentarios, $pSuperficieTerreno, $pSuperficieCubiertaTotal)
    {
        $sql = 'CALL ssp_alta_obra(:pIdGT, :pIdLocalidad, :pObra, :pDireccion, :pPropietario, :pTelefono, :pEmail, :pComentarios, :pSuperficieTerreno, :pSuperficieCubiertaTotal)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pIdLocalidad',$pIdLocalidad)
                ->bindValue('pObra', $pObra)
                ->bindValue('pDireccion', $pDireccion)
                ->bindValue('pPropietario', $pPropietario)
                ->bindValue('pTelefono', $pTelefono)
                ->bindValue('pEmail', $pEmail)
                ->bindValue('pComentarios', $pComentarios)
                ->bindValue('pSuperficieTerreno', $pSuperficieTerreno)
                ->bindValue('pSuperficieCubiertaTotal', $pSuperficieCubiertaTotal);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdObra, $pObra, $pDireccion, $pPropietario, $pTelefono, $pEmail, $pComentarios, $pSuperficieTerreno, $pSuperficieCubiertaTotal)
    {
        $sql = 'CALL ssp_modificar_obra(:pIdObra, :pObra, :pDireccion, :pPropietario, :pTelefono, :pEmail, :pComentarios, :pSuperficieTerreno, :pSuperficieCubiertaTotal)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra)
                ->bindValue('pObra', $pObra)
                ->bindValue('pDireccion', $pDireccion)
                ->bindValue('pPropietario', $pPropietario)
                ->bindValue('pTelefono', $pTelefono)
                ->bindValue('pEmail', $pEmail)
                ->bindValue('pComentarios', $pComentarios)
                ->bindValue('pSuperficieTerreno', $pSuperficieTerreno)
                ->bindValue('pSuperficieCubiertaTotal', $pSuperficieCubiertaTotal);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdObra)
    {
        $sql = 'CALL ssp_borrar_obra(:pIdObra)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra);
        return $comando->queryAll();
    }
    
    public function Baja($pIdObra)
    {
        $sql = 'CALL ssp_baja_obra(:pIdObra)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra);
        return $comando->queryAll();
    }
    
    public function Activar($pIdObra)
    {
        $sql = 'CALL ssp_activar_obra(:pIdObra)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra);
        return $comando->queryAll();
    }
    
    public function Finalizar($pIdObra)
    {
        $sql = 'CALL ssp_finalizar_obra(:pIdObra)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra);
        return $comando->queryAll();
    }
    
    public function Dame($pIdObra)
    {
        $sql = 'CALL ssp_dame_obra(:pIdObra)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdObra', $pIdObra);
        return $comando->queryAll();
    }
    
    public function Estados()
    {
        return $estados = ['0' => null, '1' => 'A', '2' => 'B', '3' => 'F'];
    }
}
