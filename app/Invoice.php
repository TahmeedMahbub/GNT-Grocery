<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    public function soldItems()
    {
        return $this->hasMany('App\SoldItem');
    }

}
