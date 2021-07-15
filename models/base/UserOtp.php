<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build
// Modified by Defri Indra
// 2021

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "user_otp".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $otp_code
 * @property integer $is_used
 * @property string $expired_at
 * @property string $created_at
 *
 * @property \app\models\User $user
 * @property string $aliasModel
 */
abstract class UserOtp extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_otp';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
                'value' => new \yii\db\Expression("NOW()"),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'otp_code'], 'required'],
            [['user_id', 'is_used'], 'integer'],
            [['expired_at'], 'safe'],
            [['otp_code'], 'string', 'max' => 6],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\User::className(), 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'otp_code' => 'Otp Code',
            'is_used' => 'Is Used',
            'created_at' => 'Created At',
            'expired_at' => 'Expired At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\UserOtpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UserOtpQuery(get_called_class());
    }


}