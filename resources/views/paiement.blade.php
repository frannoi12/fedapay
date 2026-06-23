<h1>Finaliser la commande</h1>

<form action="/checkout" method="POST">
    @csrf

    <input
        type="text"
        name="customer_name"
        placeholder="Nom complet"
        required
    >

    <input
        type="email"
        name="customer_email"
        placeholder="Email"
        required
    >

    <input
        type="number"
        name="montant"
        placeholder="Montant"
        required
    >

    <button type="submit">
        Procéder au paiement
    </button>
</form>