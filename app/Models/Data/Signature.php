<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $table = 'tbl_signature';
    protected $primaryKey = 'signature_id';

    public $timestamps = false;
}
