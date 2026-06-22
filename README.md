# Laravel 12 - Mini Boutique (Catalogue + Panier + Paiement Fedapay Sandbox)

## Auteurs
- TOYI François  
- BATAYA Crépin  

---

## Description

Application e-commerce simple développée avec Laravel 12.  
Le projet permet de gérer un catalogue de produits, un panier utilisateur basé sur session, la création de commandes et l’intégration d’un paiement en ligne via **Fedapay (sandbox)**.

Objectif principal : démonstration pédagogique du flux complet e-commerce + paiement externe.

---

## Technologies utilisées

- Laravel 12
- PHP 8+
- SQLite
- Blade (templating)
- Eloquent ORM
- Session Laravel (panier)
- Fedapay API (sandbox)

---

## Fonctionnalités

### 1. Gestion des produits (CRUD)
- Création de produits
- Modification de produits
- Suppression de produits
- Affichage du catalogue
- Upload d’image produit (storage Laravel)

---

### 2. Catalogue (page d’accueil)
- Affichage de tous les produits
- Accès rapide aux actions :
  - Ajouter au panier
  - Modifier produit
  - Supprimer produit
- Accès au panier

---

### 3. Panier (session)
- Ajout de produits au panier
- Gestion des quantités
- Suppression de produit du panier
- Calcul automatique du total

---

### 4. Commandes (Orders)
- Création automatique d’une commande lors du checkout
- Stockage des informations client :
  - Nom
  - Email
- Calcul du montant total
- Statut de paiement (`payment_status`)
- Stockage de l’identifiant transaction Fedapay

---

### 5. Détails commande (OrderItems)
- Chaque produit du panier devient une ligne de commande
- Stockage de :
  - produit
  - quantité
  - prix unitaire

---

### 6. Paiement Fedapay (Sandbox)
- Création de transaction via API Fedapay
- Redirection vers page de paiement sandbox
- Gestion des URLs :
  - callback
  - return success
- Simulation de paiement complet

---

## Flux global de l’application

```text
Produits
   ↓
Panier (Session)
   ↓
Checkout
   ↓
Création Order + OrderItems
   ↓
Appel API Fedapay (Sandbox)
   ↓
Redirection vers paiement
   ↓
Validation paiement
   ↓
Page Success
   ↓
Retour catalogue
````

---

## Base de données

### Table `products`

* id
* name
* description
* price
* image
* created_at
* updated_at

---

### Table `orders`

* id
* customer_name
* customer_email
* total_amount
* payment_status
* transaction_id
* created_at
* updated_at

---

### Table `order_items`

* id
* order_id
* product_id
* quantity
* price
* created_at
* updated_at

---

## Relations Eloquent

* Product → hasMany(OrderItem)
* Order → hasMany(OrderItem)
* OrderItem → belongsTo(Product)
* OrderItem → belongsTo(Order)

---

## Installation

```bash
git clone <repo-url>
cd project
composer install
cp .env.example .env
php artisan key:generate
```

Configurer SQLite dans `.env` :

```env
DB_CONNECTION=sqlite
```

Créer la base :

```bash
touch database/database.sqlite
```

Migrer + seed :

```bash
php artisan migrate:fresh --seed
```

---

## Seeder

Le projet inclut un seeder générant 10 produits de test.

---

## Stockage images

Lien symbolique obligatoire :

```bash
php artisan storage:link
```

---

## Routes principales

### Produits

* `/` → catalogue
* `/products/create`
* `/products/{id}/edit`
* CRUD complet

---

### Panier

* `/cart`
* `/cart/add/{id}`
* `/cart/remove/{id}`

---

### Checkout & paiement

* `/checkout`
* `/payment/success`
* `/payment/callback`

---

## Paiement Fedapay

* Mode utilisé : sandbox
* API utilisée : Fedapay REST API
* Endpoint transaction :

  ```
  https://sandbox-api.fedapay.com/v1/transactions
  ```

---

## Objectif pédagogique

Ce projet permet de comprendre :

* architecture e-commerce Laravel
* gestion panier avec session
* relations Eloquent (Order / OrderItem)
* intégration API externe (Fedapay)
* flux complet de paiement en ligne
* séparation logique des responsabilités

---

## Améliorations possibles

* Authentification utilisateur
* Historique des commandes
* Dashboard admin
* Statut de commande avancé
* Webhook Fedapay pour validation automatique
* UI moderne (Tailwind / Bootstrap)
* Pagination produits

---

## Licence

Projet académique / pédagogique.

```
IFNTI
```
