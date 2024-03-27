<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .icon {
            font-size: 100px;
            color: #008000;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            background-color: #008000;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #006400;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>TRANSACTION REUSSIE!</h1>
        <p>Bonjour cher {{ isset($mailData['name']) ? htmlspecialchars($mailData['name']) : 'Client' }},</p>
        <p>Nous sommes heureux de vous informer que votre achat de {{ isset($mailData['amount']) ? htmlspecialchars($mailData['amount']) : 'Non renseigné' }} pour l'article
            "{{ isset($mailData['article']) ? htmlspecialchars($mailData['article']) : 'Non renseigné' }}" de la
            catégorie
            "{{ isset($mailData['categorie']) ? htmlspecialchars($mailData['categorie']) : 'Non renseignée' }}"
            effectué via le moyen de paiement
            "{{ isset($mailData['paymentMethod']) ? htmlspecialchars($mailData['paymentMethod']) : 'Non renseigné' }}"
            s'est terminé avec succès.</p>
        <p>Le numéro de transaction associé à votre achat est :
            {{ isset($mailData['transactionId']) ? htmlspecialchars($mailData['transactionId']) : 'Non disponible' }}
        </p>
        <p>N'hésitez pas à nous contacter si vous avez des questions ou des préoccupations. Merci pour votre confiance.
        </p>
        <p>Cordialement,<br>SAVOIR PLUS CONSEIL</p>
    </div>
</body>

</html>
