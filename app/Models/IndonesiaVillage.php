<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndonesiaVillage extends Model {
    protected $table = 'indonesia_villages';
    protected $fillable = [
        'code',
        'district_code',
        'name',
        'meta'
    ];
    public function district() {
        return $this->belongsTo(IndonesiaDistrict::class, 'district_code', 'code');
    }
}
