<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Payment Success') }}
            </h2>
            <a href="{{ route('checkout') }}" class="btn btn-sm btn-primary px-4 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="h4 fw-bold mb-4 alert alert-success">Payment Successful</h2>
                    <p><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
                    <p><strong>Amount Paid:</strong> ${{ $payment->amount }}</p>
                    <p><strong>Name:</strong> {{ $payment->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $payment->customer_email }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
