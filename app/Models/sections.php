<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sections extends Model
{
    use HasFactory;

    protected $fillable = [
        "section_name",
        'description',
        'Created_by'
    ];

    public function section()
    {
        return $this->belongsTo('App\Models\sections');
    }
}
