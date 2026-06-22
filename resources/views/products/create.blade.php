<h1>Ajouter produit</h1>

<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf

    <input name="name" placeholder="Nom"><br>
    <textarea name="description" placeholder="Décrivez brièvement"></textarea><br>
    <input name="price" type="number" placeholder="Saisiser le prix" step="0.01"><br>
    <input type="file" name="image"><br>

    <button>Créer</button>
</form>