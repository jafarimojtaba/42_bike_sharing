<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bike".
 *
 * @property int $id
 * @property string|null $pass_before
 * @property string|null $pass_now
 * @property string|null $pass_next
 * @property int|null $available_status
 * @property string|null $hold_by
 *
 * @property BorrowedBike[] $borrowedBikes
 */
class Bike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bike';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'available_status'], 'integer'],
            [['pass_before', 'pass_now', 'pass_next', 'hold_by'], 'string', 'max' => 80],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pass_before' => 'Previous Code',
            'pass_now' => 'Current Code',
            'pass_next' => 'Next Code',
            'available_status' => 'Available',
            'hold_by' => 'Hold By',
        ];
    }

    /**
     * Gets query for [[BorrowedBikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowedBikes()
    {
        return $this->hasMany(BorrowedBike::class, ['bike_id' => 'id']);
    }
}
