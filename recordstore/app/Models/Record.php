<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $table = "records";
    protected $fillable = [
        //vilka fält ska finnas
        'name',
        'artist',
        'record_type',
        'release_year',
        'stock'
    ];

    //knyt till track-modellen. hasmany för att record kan ha många tracks
    public function tracks() {
        return $this->hasMany(Track::class);
    }
}
