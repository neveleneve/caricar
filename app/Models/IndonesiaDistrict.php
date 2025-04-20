<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndonesiaDistrict extends Model {
    protected $table = 'indonesia_districts';
    protected $fillable = [
        'code',
        'city_code',
        'name',
        'meta'
    ];
    public function city() {
        return $this->belongsTo(IndonesiaCity::class, 'city_code', 'code');
    }
    public function villages() {
        return $this->hasMany(IndonesiaVillage::class, 'district_code', 'code');
    }
}
