<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotionstatus extends Model
{
    use HasFactory;
    protected $table = "promotionstatus";
    protected $primaryKey = "studentId";

    protected $fillable = [
        'studentId',
        'schoolclassid',
        'position',
        'termid',
        'sessionid',
        'promotionStatus',

    ];
}
