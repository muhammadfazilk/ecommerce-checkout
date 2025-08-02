<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('pay') }}" method="POST" id="payment-form">
                        @csrf
                        <p>Product: <b>{{ $product->name }} - ${{ $product->price }}</b></p>
                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                        <input type="hidden" name="amount" value="{{ $product->price }}">
                        <input type="text" name="customer_name" placeholder="Name" required class="block mb-2 border rounded px-2 py-1 w-full">
                        <input type="email" name="customer_email" placeholder="Email" required class="block mb-2 border rounded px-2 py-1 w-full">
                        <div class="mb-4">
                            <label for="card-element" class="block text-gray-700 font-medium mb-2">
                                Card Details
                            </label>
                            <div id="card-element" class="border rounded px-3 py-2 shadow-sm focus:ring focus:border-blue-300 transition duration-150 ease-in-out bg-gray-50"></div>
                            <p id="card-errors" class="text-red-500 text-sm mt-2"></p>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary px-4 py-2">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        $('#payment-form').on('submit', async function(e) {
            e.preventDefault();
            const {token, error} = await stripe.createToken(card);
            if (error) {
                alert(error.message);
                return;
            }
            $('<input>').attr({
                type: 'hidden',
                name: 'stripeToken',
                value: token.id
            }).appendTo(this);
            this.submit();
        });
    </script>
</x-app-layout>