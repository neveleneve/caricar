<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndonesiaCity extends Model {
    protected $table = 'indonesia_cities';
    protected $fillable = [
        'code',
        'province_code',
        'name',
        'meta'
    ];
    public function province() {
        return $this->belongsTo(IndonesiaProvince::class, 'province_code', 'code');
    }
    public function districts() {
        return $this->hasMany(IndonesiaDistrict::class, 'city_code', 'code');
    }
}
