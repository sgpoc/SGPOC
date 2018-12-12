<?php
namespace app\models;

use Yii;

class GestorElementosConstructivos 
{
    public function Listar($pIdGT)
    {       
        $sql = 'CALL ssp_listar_elementosconstructivos(:pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdGT',$pIdGT);
        $elementos = $comando->queryAll();
        return $elementos;
    }
    
    public function ListarRubrosEC()
    {       
        $sql = 'CALL ssp_listar_rubrosec()';
        $comando = Yii::$app->db->createCommand($sql);
        $rubrosec = $comando->queryAll();
        return $rubrosec;
    }
    
    
    public function Buscar($pElementoConstructivo, $pIdRubroEC, $pIdUnidad, $pIdGT){
        $sql = 'CALL ssp_buscar_elementoconstructivo(:pElementoConstructivo, :pIdRubroEC, :pIdUnidad, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pElementoConstructivo', $pElementoConstructivo)
                ->bindValue('pIdRubroEC',$pIdRubroEC)
                ->bindValue('pIdUnidad', $pIdUnidad)
                ->bindValue('pIdGT', $pIdGT);
        $items = $comando->queryAll();
        return $items;
    }
    
    public function Alta($pElementoConstructivo, $pIdRubroEC, $pIdUnidad, $pIdGT)
    {
        $sql = 'CALL ssp_alta_elementoconstructivo(:pElementoConstructivo, :pIdRubroEC, :pIdUnidad, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pElementoConstructivo', $pElementoConstructivo)
                ->bindValue('pIdRubroEC',$pIdRubroEC)
                ->bindValue('pIdUnidad', $pIdUnidad)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }

    public function Dame($pIdElementoConstructivo, $pIdGT)
    {
        $sql = 'CALL ssp_dame_elementoconstructivo(:pIdElementoConstructivo, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdElementoConstructivo', $pIdElementoConstructivo)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function Modificar($pIdElementoConstructivo, $pIdGT, $pElementoConstructivo)
    {
        $sql = 'CALL ssp_modificar_elementoconstructivo(:pIdElementoConstructivo, :pIdGT, :pElementoConstructivo)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdElementoConstructivo', $pIdElementoConstructivo)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pElementoConstructivo',$pElementoConstructivo);
        return $comando->queryAll();
    }
    
    public function Borrar($pIdElementoConstructivo, $pIdGT)
    {
        $sql = 'CALL ssp_borrar_elementoconstructivo(:pIdElementoConstructivo, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdElementoConstructivo', $pIdElementoConstructivo)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function AgregarItem($pIdElementoConstructivo, $pIdItem, $pIdGT, $pIncidencia)
    {
        $sql = 'CALL ssp_agregar_item_elemento(:pIdElementoConstructivo, :pIdItem, :pIdGT, :pIncidencia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdElementoConstructivo', $pIdElementoConstructivo)
                ->bindValue('pIdItem',$pIdItem)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pIncidencia',$pIncidencia);
        return $comando->queryAll();
    }
    
    public function ListarItems($pIdElementoConstructivo, $pIdGT)
    {       
        $sql = 'CALL ssp_listar_items_elemento(:pIdElementoConstructivo, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdElementoConstructivo', $pIdElementoConstructivo)
                ->bindValue('pIdGT', $pIdGT);
        $items = $comando->queryAll();
        return $items;
    }  
    
    public function BorrarItem($pIdElementoConstructivo, $pIdItem, $pIdGT)
    {
        $sql = 'CALL ssp_borrar_item_elemento(:pIdElementoConstructivo, :pIdItem, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdElementoConstructivo', $pIdElementoConstructivo)
                ->bindValue('pIdItem',$pIdItem)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }

    public function DameNombre($pIdElementoConstructivo, $pIdGT){
           $sql = 'CALL ssp_dame_nombre_elemento(:pIdElementoConstructivo)';
        $comando = Yii::$app->db->createCommand($sql)
                   ->bindValue('pIdElementoConstructivo', $pIdElementoConstructivo)
                   ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
          
    }
      
    public function DameIncidenciaItemElemento($pIdElemento, $pIdItem, $pIdGT){
        $sql = 'CALL ssp_dame_incidencia_item_elemento(:pIdElemento, :pIdItem, :pIdGT)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdElemento', $pIdElemento)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
    
    public function ModificarIncidencia($pIdElemento, $pIdItem, $pIdGT, $pIncidencia)
    {
        $sql = 'CALL ssp_modificar_incidencia_item(:pIdElemento, :pIdItem, :pIdGT, :pIncidencia)';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdElemento', $pIdElemento)
                ->bindValue('pIdItem', $pIdItem)
                ->bindValue('pIdGT', $pIdGT)
                ->bindValue('pIncidencia',$pIncidencia);
        return $comando->queryAll();
    }
    
    public function DameElementoExportar($pIdEC, $pIdGT){
        $sql = 'SELECT ElementoConstructivo,RubroEC FROM ElementosConstructivos ec
        JOIN Rubrosec re ON ec.IdRubroEC = re.IdRubroEC
        WHERE ec.IdElementoConstructivo = :pIdEC AND ec.IdGT = :pIdGT';
        $comando = Yii::$app->db->createCommand($sql)
                ->bindValue('pIdEC', $pIdEC)
                ->bindValue('pIdGT', $pIdGT);
        return $comando->queryAll();
    }
      
    }



