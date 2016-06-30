<?php

namespace app\models;
use \yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;

use Yii;

/**
 * This is the model class for table "profesion".
 *
 * @property integer $id
 * @property string $profesion
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Persona[] $personas
 */
class Profesion extends MiActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profesion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['profesion', 'filter', 'filter' => 'stroupper'],
            ['profesion', 'trim'],
            [['profesion'], 'required', 'message' => 'por favor complete este campo'],
            ['profesion', 'unique'],
            [['created_by', 'updated_by'], 'integer'],
            //['profesion', 'string', 'max' => 3],
            //['profesion', 'url', 'defaultScheme' => 'http', 'message' => 'URL inválida'],
            //['created_at', 'required'],
        ];
    }
    /*
    public function behaviors()
    {
        return [    
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'profesion',
                // 'slugAttribute' => 'slug',
            ],
        ];
    }
    */
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            
            if ($insert) {
                echo "todo lo que queramos antes de insertar";
                exit;
            } else {
                echo "todo lo que queramos antes de actualizar";
                exit;
            }
            
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profesion' => 'Profesion',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getFecha()
    {
        setlocale(LC_TIME, 'es_CO.UTF-8');

        $fecha = strftime("%c", strtotime($this->created_at));
        return $fecha;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['profesion_id' => 'id']);
    }
}
