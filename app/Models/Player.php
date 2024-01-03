<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function createdBy(){
        return $this->belongsTo(User::class,'createdBy');
    }
    public function modifiedBy(){
        return $this->belongsTo(User::class,'modifiedBy');
    }
}
