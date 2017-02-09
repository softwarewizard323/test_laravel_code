<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class SourceReview extends Model
{
    protected $table = 'tbl_source_reviews';
    protected $primaryKey = 'tsr_id';

    public $timestamps = false;

    public function source()
    {
        return $this->belongsTo('App\Models\Data\Source', 'source_id');
    }
}
