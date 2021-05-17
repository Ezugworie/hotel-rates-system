<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;


class Rate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'start_date',
      'end_date',
      'adult_rate',
      'child_rate',
      'hotel_id'
  ];


    public function hotel()
    {
      return $this->belongsTo(Hotel::class);
    }
}
