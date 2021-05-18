<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rate;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stars',
        'address',
    ];


    public function rates()
    {
      return $this->hasMany(Rate::class);
    }
}
