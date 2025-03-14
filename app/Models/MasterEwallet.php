<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterEwallet extends Model
{
    use HasFactory;

    protected $table = 'm_ewallet';

    protected $fillable = ['name','color','color2'];
}
