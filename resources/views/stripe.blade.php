@extends('maindesign')

@section('pay_now')
<div class="container my-5 border p-4">
    <h2 class="mb-4 text-center">Paiement par Carte</h2>


    <form action="{{ route('poststripe') }}" method="POST" id="payment-form">
        @csrf
        <input type="hidden" name="total" value="{{ $price }}">

        {{-- Adresse --}}
        <div class="mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="address" class="form-control" placeholder="Votre adresse" required>
        </div>

        {{-- Téléphone --}}
        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" placeholder="Votre téléphone" required>
        </div>

        {{-- Stripe Elements --}}
        <div class="mb-3">
            <label class="form-label">Numéro de carte</label>
            <div id="card-number" class="form-control"></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Date d'expiration</label>
            <div id="card-expiry" class="form-control"></div>
        </div>

        <div class="mb-3">
            <label class="form-label">CVC</label>
            <div id="card-cvc" class="form-control"></div>
        </div>

        <button class="btn btn-primary w-100">Pay Now ({{ $price }} MAD)</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();

    const cardNumber = elements.create('cardNumber');
    cardNumber.mount('#card-number');

    const cardExpiry = elements.create('cardExpiry');
    cardExpiry.mount('#card-expiry');

    const cardCvc = elements.create('cardCvc');
    cardCvc.mount('#card-cvc');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const {token, error} = await stripe.createToken(cardNumber);
        if (error) {
            alert(error.message);
        } else {
            // Ajouter le token Stripe au formulaire
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'stripeToken';
            input.value = token.id;
            form.appendChild(input);
            form.submit();
        }
    });
</script>
@endsection
