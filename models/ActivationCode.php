<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activation_code".
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $intraname
 * @property int|null $sent_code
 */
class ActivationCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activation_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'intraname'], 'required'],
            [['sent_code'], 'integer'],
            [['email', 'intraname'], 'string', 'max' => 80],
            [['email'], 'unique'],
            [['intraname'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'intraname' => 'Intra Name',
            'sent_code' => 'Sent Code',
        ];
    }
}
