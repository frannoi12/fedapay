<h1>Modifier produit</h1>

<form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input name="name" value="{{ $product->name }}"><br>
    <textarea name="description">{{ $product->description }}</textarea><br>
    <input name="price" type="number" value="{{ $product->price }}"><br>

    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" width="100">
    @endif

    <input type="file" name="image"><br>

    <button>Mettre à jour</button>
</form>