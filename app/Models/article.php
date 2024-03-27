<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;
    protected $table = "articles";

    protected $fillable = [
        'nom_article', 'prix', 'type_prix', 'nombre_par_duree', 'duree', 'categorie_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(categorie::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(transaction::class, 'article_transactions', 'article_id', 'transaction_id');
    }
}
