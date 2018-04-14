<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $dt
 * @property string $firstname
 * @property string $lastname
 * @property int $deleted
 * @property string $registerstate
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dt'], 'safe'],
            [['email', 'firstname', 'lastname'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 60],
            [['deleted'], 'string', 'max' => 1],
            [['registerstate'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'dt' => 'Dt',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'deleted' => 'Deleted',
            'registerstate' => 'Registerstate',
        ];
    }
}
