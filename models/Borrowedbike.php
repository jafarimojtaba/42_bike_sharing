<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "borrowedbike".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $bike_id
 * @property string|null $date_borrowed
 * @property string|null $date_returned
 * @property string|null username
 *
 * @property Bike $bike
 * @property NewUser $user
 */
class Borrowedbike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrowedbike';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'bike_id'], 'integer'],
            [['date_borrowed', 'date_returned', 'username'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewUser::class, 'targetAttribute' => ['user_id' => 'id']],
            [['bike_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bike::class, 'targetAttribute' => ['bike_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'User',
            'bike_id' => 'Bike',
            'date_borrowed' => 'Pickup Time',
            'date_returned' => 'Return Time',
        ];
    }

    /**
     * Gets query for [[Bike]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBike()
    {
        return $this->hasOne(Bike::class, ['id' => 'bike_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(NewUser::class, ['id' => 'user_id']);
    }
}
