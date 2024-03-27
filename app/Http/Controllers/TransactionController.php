<?php

namespace App\Http\Controllers;

use App\Mail\payMail;
use App\Models\article;
use App\Models\articleTransaction;
use App\Models\categorie;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function produits()
    {
        //Je renvoie sur la vue savpay c'est a dire la page principale
        //tous les produits principaux et leurs catégories pour servir de vitrine
        $articles = article::with('categorie')
            ->whereHas('categorie', function ($query) {
                $query->where('nom', '!=', 'autres');
            })
            ->get()
            ->load('categorie');


        return view('savshop', compact('articles'));
    }

    public function success(Request $request, $id)
    {
        //Je recupere les informations de la transaction effetué depuis le widget dans la vue
        //Puis je les enregistrent dans les tables transactions,et article_transactions

        $public_key = config('kkiapay.public_key');
        $private_key = config('kkiapay.private_key');
        $secret = config('kkiapay.secret');
        $sandbox = config('kkiapay.sandbox');

        $kkiapay = new \Kkiapay\Kkiapay(
            $public_key,
            $private_key,
            $secret,
            $sandbox
        );
        $transactionData = $request->all();
        Log::info($request->all());

        $transactionId = $transactionData['transaction_id'];

        $transactionDetails = $kkiapay->verifyTransaction($transactionId);

        Log::info(get_object_vars($transactionDetails));
        if ($transactionDetails->status === 'SUCCESS') {
            // Enregistre les données de la transaction dans la base de données
            $transaction = Transaction::create([
                'name' => $transactionDetails->client->fullname ?? null,
                'email' => $transactionDetails->client->email ?? null,
                'phone' => $transactionDetails->client->phone ?? null,
                'amount' => $transactionDetails->amount,
                'status' => $transactionDetails->status,
                'token' => $transactionId ?? null,
                'payment_method' => $transactionDetails->source ?? null,
            ]);

            ArticleTransaction::create([
                'article_id' => $id,
                'transaction_id' => $transaction->id,
            ]);

            $state = json_decode(json_encode($transactionDetails->state), true);


            $email = $transaction->email;
            $nom = $transaction->name;
            $mailData = [
                'name' => $nom,
                'amount' => $transaction->amount,
                'status' => $transaction->status,
                'transactionId' => $transactionId,
                'paymentMethod' => $transactionDetails->source ?? 'Non renseignée',
                'article' => $state['article'] ?? 'Non renseigné',
                "categorie" => $state['categorie'] ?? 'Non renseignée'
            ];
           

            Mail::to($email)->queue(new payMail($email, $mailData));
            

            return redirect()->route('emails.index')->with('success', 'Le mail a été envoyé avec succès ! Consultez votre boîte mail');
        } else {
            // Gérer le cas où la transaction a échoué
            return response()->json(['error' => 'La transaction a échoué'], 400);
        }
    }

    public function saveArticle(Request $request)
    {

        //J'enregistre les informations  de l'article et je renvoie son id  avant d'etre utiliser dans le front-end pour le payment 
        //via le widget de kkiapay

        $article = Article::create([
            'nom_article' => $request->input('article'),
            'prix' => $request->input('prix'),
            'type_prix' => 'perso',
            'nombre_par_duree' => 1,
            'categorie_id' => 4
        ]);

        // Renvoie une réponse JSON avec l'ID de l'article nouvellement créé
        return response()->json(['id' => $article->id]);
    }


    public function othersuccess(Request $request, $id)
    {
        //pareil que success() seulement j'enregistre a al fois dans articles,transactions et articleTransactions
        $public_key = config('kkiapay.public_key');
        $private_key = config('kkiapay.private_key');
        $secret = config('kkiapay.secret');
        $sandbox = config('kkiapay.sandbox');

        $kkiapay = new \Kkiapay\Kkiapay(
            $public_key,
            $private_key,
            $secret,
            $sandbox
        );
        $transactionData = $request->all();
        Log::info($request->all());

        $transactionId = $transactionData['transaction_id'];

        $transactionDetails = $kkiapay->verifyTransaction($transactionId);

        Log::info(get_object_vars($transactionDetails));

        if ($transactionDetails->status === 'SUCCESS') {
            // Enregistre les données de la transaction dans la base de données
            $transaction = transaction::create([
                'name' => $transactionDetails->client->fullname ?? null,
                'email' => $transactionDetails->client->email ?? null,
                'phone' => $transactionDetails->client->phone ?? null,
                'amount' => $transactionDetails->amount,
                'status' => $transactionDetails->status,
                'token' => $transactionId ?? null,
                'payment_method' => $transactionDetails->source ?? null,

            ]);

            articleTransaction::create([
                'article_id' => $id,
                'transaction_id' => $transaction->id,
            ]);
            $email = $transaction->email;
            $nom = $transaction->name;
            $state = $transactionDetails->state;
            $mailData = [
                'name' => $nom,
                'amount' => $transaction->amount,
                'status' => $transaction->status,
                'transactionId' => $transactionId,
                'paymentMethod' => $transactionDetails->source ?? 'Non renseignée',
                'article' => $state->article ?? 'Non renseigné',
                "categorie_article" => $state->categorie ?? 'Non renseignée'

            ];

            Mail::to($email)->queue(new payMail($email, $mailData));
            return redirect()->route('emails.index')->with('success', 'Le mail a été envoyé avec succès !Consultez votre boîte mail');
        } else {
            // Gérer le cas où la transaction a échoué
            return response()->json(['error' => 'La transaction a échoué'], 400);
        }
    }
    public function getCategories()
    {
        //API qui retourne au front end toutes les categories de services ou d'articles
        $categories = categorie::all();
        return response()->json($categories);
    }
}
