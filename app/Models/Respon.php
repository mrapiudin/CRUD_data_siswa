<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Respon extends Model
{
    use HasFactory;
    protected $table = 'respons';
    protected $fillable = ['respon_status','repot_id'];


    public function repot()
    {
        return $this->belongsTo(Repot::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'repot_id', 'repot_id');
    }
}
