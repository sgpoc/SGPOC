<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Proveedores extends Model
{
    public $IdProveedor;
    public $IdGT;
    public $Proveedor;
    public $Domicilio;
    public $CodigoPostal;
    public $Email;
    public $Telefono;
    public $PaginaWEB;
    public $Estado;

    
    public static function tableName()
    {
        return 'proveedores';
    }

    public function rules()
    {
        return [
            [['Proveedor', 'Domicilio', 'CodigoPostal'], 'required'],
            [['Proveedor', 'Domicilio', 'Email', 'PaginaWEB'], 'string', 'max' => 100],
            [['CodigoPostal'], 'string', 'max' => 15],
            [['Telefono'], 'string', 'max' => 30],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdProveedor' => 'Proveedor',
            'Proveedor' => 'Proveedor',
            'Domicilio' => 'Domicilio',
            'CodigoPostal' => 'Codigo Postal',
            'Email' => 'Email',
            'Telefono' => 'Telefono',
            'PaginaWEB' => 'Pagina Web',
            'Estado' => 'Estado',
        ];
    }
}
