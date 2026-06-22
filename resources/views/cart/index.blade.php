<h1>Mon panier</h1>

@php $total = 0; @endphp

<a href="{{ url('/') }}">retour</a>

@foreach($cart as $id => $item)
    <div>
        <h3>{{ $item['name'] }}</h3>
        <p>Prix: {{ $item['price'] }}</p>
        <p>Quantité: {{ $item['quantity'] }}</p>

        @php $total += $item['price'] * $item['quantity']; @endphp

        <a href="{{ url('/cart/remove/'.$id) }}">Supprimer</a>
    </div>
@endforeach

<h2>Total: {{ $total }}</h2>

<a href="/show-checkout">Passer au paiement</a>