<?php

namespace app\models;

class Dompet extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['date', 'action', 'amount'], 'required']
        ];
    }
    public function arrayAction()
    {
        return [
            0 => 'Pengeluaran',
            1 => "Pemasukan"
        ];
    }

}