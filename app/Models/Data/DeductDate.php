<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class DeductDate extends Model
{
    protected $table = 'tbl_deduct_date';
    protected $primaryKey = 'last_deduct_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'status'];
}