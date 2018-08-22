<?php

namespace app\models;
use yii\base\Model;
use Yii;



class Proveedores extends Model
{
    public $IdProveedor;
    public $Proveedor;
    public $Domicilio;
    public $CodigoPostal;
    public $Email;
    public $Telefono;
    public $PaginaWEB;
    public $Estado;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * {@inheritdoc}
     */
     
    public function rules()
    {
        return [
            [['Proveedor', 'Domicilio', 'CodigoPostal', 'Estado'], 'required'],
            [['Proveedor', 'Domicilio', 'Email', 'PaginaWEB'], 'string', 'max' => 100],
            [['CodigoPostal'], 'string', 'max' => 15],
            [['Telefono'], 'string', 'max' => 30],
            [['Estado'], 'string', 'max' => 1],
            [['Proveedor'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdProveedor' => 'IdProveedor',
            'Proveedor' => 'Proveedor',
            'Domicilio' => 'Domicilio',
            'CodigoPostal' => 'Codigo Postal',
            'Email' => 'Email',
            'Telefono' => 'Telefono',
            'PaginaWEB' => 'Pagina Web',
            'Estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListadeprecios()
    {
        return $this->hasMany(Listadeprecios::className(), ['IdProveedor' => 'IdProveedor']);
    }
}
