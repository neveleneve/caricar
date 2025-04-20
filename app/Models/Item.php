<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    protected $fillable = [
        'name',
        'description',
        'brand_id',
        'user_id',
        'condition',
    ];
    public function brand() {
        return $this->belongsTo(Brand::class)->withTrashed();
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function itemDetails() {
        return $this->hasOne(ItemDetail::class);
    }
    public function itemImages() {
        return $this->hasMany(ItemImage::class);
    }
    public function itemDocument() {
        return $this->hasMany(ItemDocument::class);
    }
}
