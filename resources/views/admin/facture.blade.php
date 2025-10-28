<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $order->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
            color: #2c3e50;
        }
        .details, .product {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details td, .product th, .product td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        .product th {
            background: #f4f4f4;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <h2>Facture</h2>
        <p>Commande #{{ $order->id }}</p>
    </div>

    {{-- Informations Client --}}
    <table class="details">
        <tr>
            <td><strong>Nom :</strong> {{ $order->name }}</td>
            <td><strong>Téléphone :</strong> {{ $order->telephone }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Adresse :</strong> {{ $order->address }}</td>
        </tr>
    </table>

    {{-- Détails Produit --}}
    <table class="product">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Status</th>
                <th>Date de commande</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->product->name }}</td>
                <td>{{ number_format($order->product->prix, 2) }} MAD</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Total --}}
    <div class="total">
        Total : {{ number_format($order->product->prix, 2) }} MAD
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Merci pour votre commande !</p>
    </div>
</body>
</html>
