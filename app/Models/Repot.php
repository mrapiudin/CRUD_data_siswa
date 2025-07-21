<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Repot extends Model
{
    use HasFactory;
    protected $table = 'repots';
    protected $fillable = ['keluhan','type','provinsi', 'kota', 'kecamatan', 'desa', 'voting','viewers', 'image', 'statment','user_id' ];   

    public function user()
    {
        return $this->belongsTo(User::class);
    }   

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function respon()
    {
        return $this->hasOne(Respon::class);
    }

    public function history()
    {
        return $this->hasMany(History::class, 'repot_id');
    }
    public function vote()
    {
        $userId = Auth::id();
        $voting = json_decode($this->voting, true);

        if (!in_array($userId, $voting)) {
            $voting[] = $userId; // Add user ID to the voting array
            $this->voting = json_encode($voting);
            $this->save();
        }
    }
}


