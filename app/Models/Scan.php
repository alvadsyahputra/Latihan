<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    use HasFactory;
    protected $table = 'scan';

    
    public function user_created(){
        return $this->hasOne(User::class,'id',"create_by");
        
    }
}
