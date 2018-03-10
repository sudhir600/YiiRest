<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todo".
 *
 * @property int $id
 * @property string $user
 * @property int $status
 * @property string $remark
 */
class Todo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'todo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'status', 'remark'], 'required'],
            [['status'], 'integer'],
            [['user'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'status' => 'Status',
            'remark' => 'Remark',
        ];
    }
}
