<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <h3 class="text-2xl font-bold mb-4">Complete Payment</h3>
                <p class="text-gray-600 mb-6">Total Amount: <span class="font-bold text-indigo-600">Rp
                        {{ number_format($grandTotal, 0, ',', '.') }}</span></p>

                <button id="pay-button"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg">
                    Pay Now
                </button>

                <div class="mt-8 text-sm text-gray-500">
                    Payment Reference: {{ $paymentReference }}
                </div>
            </div>
        </div>
    </div>

    @php
        $snapUrl = config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
        $clientKey = config('midtrans.client_key');
    @endphp

    @push('scripts')
        <script src="{{ $snapUrl }}" data-client-key="{{ $clientKey }}"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function () {
                // SnapToken acquired from previous step
                snap.pay('{{ $snapToken }}', {
                    // Optional
                    onSuccess: function (result) {
                        window.location.href = "{{ route('checkout.finish') }}?order_id={{ $paymentReference }}";
                    },
                    onPending: function (result) {
                        window.location.href = "{{ route('checkout.finish') }}?order_id={{ $paymentReference }}";
                    },
                    onError: function (result) {
                        /* You may add your own implementation here */
                        alert("payment failed!"); console.log(result);
                    },
                    onClose: function () {
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                });
            };
        </script>
    @endpush
</x-app-layout>