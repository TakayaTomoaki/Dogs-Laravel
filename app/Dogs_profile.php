<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dogs_profile extends Model
{
    protected $table = 'dogs_profiles';

    protected $guarded = array('id');

    public static $rules = array(
        'dog_name' => 'required',
        'dog_age' => 'required',
        'dog_gender' => 'required',
        'dog_weight' => 'required',
        'dog_father' => 'required',
        'dog_mother' => 'required',
    );
}
