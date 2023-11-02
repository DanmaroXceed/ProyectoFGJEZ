<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal extends Model
{
    use HasFactory;

    protected $fillable = [
        "address", 
        "brtDay",
        "gen",
        "file",
        "verif",
        "user_id",
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
