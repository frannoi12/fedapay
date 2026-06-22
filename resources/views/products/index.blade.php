<h1>Produits</h1>

<a href="{{ route('products.create') }}">Ajouter</a>

@foreach($products as $product)
    <div>
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->price }} FCFA</p>

        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" width="100">
        @endif

        <a href="{{ route('products.edit', $product) }}">Modifier</a>

        <form method="POST" action="{{ route('products.destroy', $product) }}">
            @csrf
            @method('DELETE')
            <button>Supprimer</button>
        </form>
    </div>
@endforeach