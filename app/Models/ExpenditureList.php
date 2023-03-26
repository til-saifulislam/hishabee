<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'exp_seg_id', 'amount', 'payment_account_id'];
}
