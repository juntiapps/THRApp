<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Jika belum ada

class Project extends Model
{
    use HasFactory;
    use HasUuids; // Tambahkan trait ini

    protected $fillable = ['name','url','user_id'];
}
