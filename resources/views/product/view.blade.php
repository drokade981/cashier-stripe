@extends('layouts.app')
@section('title', 'Product Detail')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product Detail</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                      <div class="col-12 col-sm-8">
                        <div class="info-box bg-light">
                          <div class="info-box-content">
                            <table class="table">
                              <tr>
                                <td>Name : {{ $product->name}}</td>
                              </tr>
                              <tr>
                                <td>Price : {{ $product->price}}</td>
                              </tr>
                              <tr>
                                <td>Description : {{ $product->description}}</td>
                              </tr>
                            </table>
                           
                          </div>
                        </div>
                      </div>
                    </div>

                    <form action="{{ route('products.charge', $product->id) }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <div>
                          <label for="card-holder-name">Name on Card</label>
                          <input id="card-holder-name" type="text" value="{{$user->name}}" disabled>
                      </div>

                      <div >
                          <label for="card-element control-label">Credit or debit card</label>
                          <div id="card-element">
                              <!-- A Stripe Element will be inserted here. -->
                          </div>
                          <div id="card-errors" role="alert"></div>
                          <div class="stripe-errors"></div>
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                            </div>
                            @endif
                      </div>

                      <button class="btn btn-success mt-5" id="card-button" data-secret="{{ $intent->client_secret }}">
                          Pay  ${{ $product->price }}
                      </button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();

        var card = elements.create('card', {hidePostalCode: true});
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        const paymentMethodInput = document.getElementById('payment-method');

        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();

            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
            } else {
                // The card has been verified successfully...
                console.log(card);
                
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', setupIntent.payment_method);
                form.appendChild(hiddenInput);
                form.submit();
                // document.getElementById('payment-form').submit();
            }
        });
    </script>

@endsection  