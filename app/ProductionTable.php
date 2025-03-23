<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionTable extends Model
{
    use HasFactory;
    
    protected $table = "tbl_production_tables";

    protected $fillable = ['table_name', 'floor_id', 'number_of_seats', 'description'];

    public function floor() {
        return $this->belongsTo(Floor::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function availableSeats() {
        return $this->number_of_seats - $this->users()->count();
    }
}
