Hi {{ $user->full_name }},
Namens de barcommisie willen wij graag je jouw overzicht van van het barsysteem aanbieden.
Je huidige saldo is: €{{ $user->balance / 100 }}

@if($user->orders != "[]")
    Hieronder zult je al uw bestellingen terugvinden die je vanaf het ingaan van het nieuwe systeem heeft
    gekocht. Dit overzicht is
    van {{ \Carbon\Carbon::now()->startOfMonth()->subMonth()->toDateString() }}
    tot {{ \Carbon\Carbon::now()->firstOfMonth()->toDateString() }}

    @foreach($user->orders as $order)

        {{ $order->created_at }}
        @foreach($order->products as $product){{ $product->name }}@if (!$loop->last)
            ,@endif @endforeach

    @endforeach

@else
    Je heb niets gekocht in de periode
    van {{ \Carbon\Carbon::now()->startOfMonth()->subMonth()->toDateString() }}
    tot {{ \Carbon\Carbon::now()->firstOfMonth()->toDateString() }}.
@endif
