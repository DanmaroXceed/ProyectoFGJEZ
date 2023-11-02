<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extravio extends Model
{
    use HasFactory;

    protected $fillable = [
        "nameDoc", 
        "docDesc",
        "date",
        "place",
        "escDesc",
        "user_id",
        "verif",
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
