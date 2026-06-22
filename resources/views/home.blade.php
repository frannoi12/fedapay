<h1>Catalogue Produits</h1>

<a href="{{ route('products.create') }}">+ Ajouter un produit</a>
<a href="{{ url('/cart') }}">Voir panier</a>

<hr>

@foreach($products as $product)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->description }}</p>
        <p><strong>{{ $product->price }} FCFA</strong></p>

        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" width="120">
        @endif

        <br><br>

        <!-- PANIER -->
        <a href="{{ url('/cart/add/'.$product->id) }}">
            Ajouter au panier
        </a>

        <!-- EDIT -->
        <a href="{{ route('products.edit', $product) }}">
            Modifier
        </a>

        <!-- DELETE -->
        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Supprimer ce produit ?')">
                Supprimer
            </button>
        </form>

    </div>
@endforeach