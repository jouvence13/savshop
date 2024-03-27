<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";

    protected $fillable = [
        'name', 'email', 'phone', 'amount', 'status', 'token', 'payment_method'
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_transactions', 'transaction_id', 'article_id');
    }
}
