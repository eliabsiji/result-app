<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schoolhouse extends Model
{
    use HasFactory;
    protected $table = "schoolhouses";
    //protected $primaryKey = "studentid";

    protected $fillable = [
        'housemasterid',
        'house',
        'housecolour',
        'termid',
        'sessionid',
          ];
}
