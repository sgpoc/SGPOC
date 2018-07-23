<?php

namespace app\models;
use yii\base\Model;

class GruposTrabajo extends Model
{
    public $IdGT;
    public $GrupoTrabajo;
    public $Mail;
    public $Estado;
    
    public static function tableName()
    {
        return 'grupostrabajo';
    }

    
    public function rules()
    {
        return [
            [['IdGT', 'GrupoTrabajo', 'Mail', 'Estado'], 'required'],
            [['IdGT'], 'integer'],
            [['GrupoTrabajo', 'Mail', 'Estado'], 'string', 'max' => 100],
            [['IdGT'], 'unique'],
            [['GrupoTrabajo'], 'unique'],
            [['Mail'], 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdGT' => 'Id Gt',
            'GrupoTrabajo' => 'Grupo Trabajo',
            'Mail' => 'Mail',
            'Estado' => 'Estado',
        ];
    }
    
    public function dameGrupoTrabajo($pIdGT)
    {
        return $this->queryOne($pIdGT);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamilias()
    {
        return $this->hasMany(Familias::className(), ['IdGT' => 'IdGT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObras()
    {
        return $this->hasMany(Obras::className(), ['IdGT' => 'IdGT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['IdGT' => 'IdGT']);
    }
    

}
