<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    //

    public function student(){
        return $this->hasMany(Student::class);
    }
}
