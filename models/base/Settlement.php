<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "settlement".
 *
 * @property integer $id
 * @property string $settlement_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $first_party_id
 * @property string $first_party_event_id
 * @property integer $first_party_capacity
 * @property string $second_party_event_id
 * @property integer $second_party_capacity
 * @property string $second_party_date
 * @property integer $second_party_artist_id
 * @property integer $second_party_venue_id
 * @property string $note
 * @property string $artist_walkout_final
 * @property string $ad_plan_final
 * @property string $promoter_revenue_final
 * @property string $ticket_sales_final
 *
 * @property \app\models\Company $firstParty
 * @property \app\models\Offer $firstPartyEvent
 * @property \app\models\Offer $secondPartyEvent
 * @property \app\models\User $secondPartyArtist
 * @property \app\models\Venue $secondPartyVenue
 */
class Settlement extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['settlement_id', 'first_party_event_id', 'second_party_event_id'], 'required'],
            [['created_at', 'updated_at', 'second_party_date'], 'safe'],
            [['first_party_id', 'first_party_capacity', 'second_party_capacity', 'second_party_artist_id', 'second_party_venue_id'], 'integer'],
            [['artist_walkout_final', 'ad_plan_final', 'promoter_revenue_final', 'ticket_sales_final'], 'number'],
            [['settlement_id', 'first_party_event_id', 'second_party_event_id'], 'string', 'max' => 45],
            [['note'], 'string', 'max' => 8000],
            [['settlement_id'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settlement';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'settlement_id' => 'Settlement ID',
            'first_party_id' => 'First Party ID',
            'first_party_event_id' => 'First Party Event ID',
            'first_party_capacity' => 'First Party Capacity',
            'second_party_event_id' => 'Second Party Event ID',
            'second_party_capacity' => 'Second Party Capacity',
            'second_party_date' => 'Second Party Date',
            'second_party_artist_id' => 'Second Party Artist ID',
            'second_party_venue_id' => 'Second Party Venue ID',
            'note' => 'Note',
            'artist_walkout_final' => 'Artist Walkout Final',
            'ad_plan_final' => 'Ad Plan Final',
            'promoter_revenue_final' => 'Promoter Revenue Final',
            'ticket_sales_final' => 'Ticket Sales Final',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstParty()
    {
        return $this->hasOne(\app\models\Company::className(), ['id' => 'first_party_id'])->inverseOf('settlements');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstPartyEvent()
    {
        return $this->hasOne(\app\models\Offer::className(), ['event_id' => 'first_party_event_id'])->inverseOf('settlements');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondPartyEvent()
    {
        return $this->hasOne(\app\models\Offer::className(), ['event_id' => 'second_party_event_id'])->inverseOf('settlements');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondPartyArtist()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'second_party_artist_id'])->inverseOf('settlements');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondPartyVenue()
    {
        return $this->hasOne(\app\models\Venue::className(), ['id' => 'second_party_venue_id'])->inverseOf('settlements');
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
}
