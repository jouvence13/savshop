<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articleTransaction extends Model
{
    use HasFactory;

    protected $table = "article_transactions";

    protected $fillable = [
        'article_id', 'transaction_id'
    ];
}
