<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    //
    public function get($id)
    {
        return $this->where('player_id',$id)->first();
    }

    public function list()
    {
        return $this->select('player_id', 'first_name', 'second_name')->get();
    }
}
