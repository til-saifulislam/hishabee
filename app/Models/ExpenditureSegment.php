<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureSegment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'exp_title'];
}
