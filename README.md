# Projet Laravel 12 - Mini boutique (Catalogue + Panier)

## Description

Ce projet est une application Laravel 12 simple de type e-commerce.  
Il permet de gérer des produits, un panier utilisateur basé sur la session et prépare la structure pour une future intégration de paiement.

---

## Technologies utilisées

- Laravel 12
- SQLite
- Blade (templates)
- Eloquent ORM
- Sessions Laravel (panier)
- Bootstrap (optionnel / futur ajout)

---

## Fonctionnalités

### Produits
- Création de produits
- Modification de produits
- Suppression de produits
- Affichage de la liste des produits
- Upload d’image produit (stockée dans `storage`)

### Catalogue (page d’accueil)
- Affichage de tous les produits
- Accès rapide aux actions :
  - Ajouter au panier
  - Modifier produit
  - Supprimer produit
- Lien vers création de produit

### Panier (session)
- Ajouter un produit au panier
- Incrémenter la quantité si déjà existant
- Afficher le contenu du panier
- Supprimer un produit du panier
- Calcul du total

---

## Base de données

### Table `products`
- id
- name
- description
- price
- image
- created_at
- updated_at

### Table `orders`
- id
- customer_name
- customer_email
- total_amount
- payment_status
- transaction_id
- created_at
- updated_at

### Table `order_items`
- id
- order_id
- product_id
- quantity
- price
- created_at
- updated_at

---

## Relations Eloquent

- Product → hasMany(OrderItem)
- Order → hasMany(OrderItem)
- OrderItem → belongsTo(Product)
- OrderItem → belongsTo(Order)

---

## Seeder

Le projet contient un seeder permettant de générer automatiquement 10 produits de test :

```bash
php artisan db:seed
````

Ou :

```bash
php artisan migrate:fresh --seed
```

---

## Routes principales

### Produits

* GET `/` → Liste des produits
* GET `/products/create` → Formulaire création
* POST `/products` → Enregistrer produit
* GET `/products/{id}/edit` → Modifier produit
* PUT `/products/{id}` → Update produit
* DELETE `/products/{id}` → Supprimer produit

### Panier

* GET `/cart` → Voir panier
* GET `/cart/add/{id}` → Ajouter produit
* GET `/cart/remove/{id}` → Retirer produit

---

## Stockage des images

Les images sont stockées dans :

```
storage/app/public/products
```

Lien symbolique requis :

```bash
php artisan storage:link
```

---

## Structure globale du projet

```
app/
 ├── Http/Controllers
 │    ├── ProductController
 │    ├── CartController
 │
 ├── Models
 │    ├── Product
 │    ├── Order
 │    ├── OrderItem
```

---

## Objectif pédagogique

Ce projet sert de base pour :

* Comprendre Laravel CRUD
* Gérer une session panier
* Manipuler Eloquent relations
* Préparer un système de paiement (future étape)

---

## Améliorations futures

* Système de paiement (Stripe / CinetPay / Fedapay)
* Authentification utilisateur
* Historique des commandes
* Dashboard admin
* Design UI amélioré (Bootstrap / Tailwind)

---

## Auteur

Projet développé dans un but pédagogique pour l’apprentissage de Laravel et des systèmes e-commerce simples.

```
```
