<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;


    protected $fillable=['name','price','img','travel_time','city_id'];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function scopefindPosts($query, $find) {
        if($find) {
            return $query->where('name','like',"%$find%");
        } else {
            return $query;
        }
    }

    public function scopefilter($query, $cityId)
    {
        if ($cityId) {
            return $query->where('city_id', $cityId);
        }
        return $query;
    }
}
