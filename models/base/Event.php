<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "event".
 *
 * @property integer $id
 * @property string $action
 * @property integer $mp_id
 * @property string $start
 * @property string $stop
 * @property string $note
 */
class Event extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action'], 'required'],
            [['action'], 'string'],
            [['mp_id'], 'integer'],
            [['start', 'stop'], 'safe'],
            [['note'], 'string', 'max' => 2550]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => 'Action',
            'mp_id' => 'Mp ID',
            'start' => 'Start',
            'stop' => 'Stop',
            'note' => 'Note',
        ];
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'start',
                'updatedAtAttribute' => false,
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\EventQuery(get_called_class());
    }
}
