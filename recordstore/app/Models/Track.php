<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = "tracks";
         //vilka fält ska finnas
    protected $fillable = ['title', 'length', 'track_no', 'record_id'];
   
    //knyt ihop med tabellen record
    public function record() {
        return $this->belongsTo(Record::class);
    }
}
