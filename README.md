# Gestion des Plaintes du Parquet

Cette application Laravel permet de gérer les plaintes au sein d'un parquet, y compris la gestion des dossiers, audiences, jugements, et pièces justificatives.

## Fonctionnalités

- **Gestion des plaintes** : Créez, modifiez, et supprimez des plaintes. Les plaintes peuvent être associées à un plaignant et un accusé.
- **Gestion des parties** : Enregistrez les informations des plaignants et des accusés.
- **Gestion des dossiers** : Suivez l'évolution des plaintes à travers des dossiers. Chaque dossier peut inclure des audiences, des jugements et des pièces justificatives.
- **Gestion des audiences** : Planifiez et enregistrez les audiences associées à un dossier.
- **Gestion des jugements** : Enregistrez les jugements pour chaque dossier, incluant la décision prise par le tribunal.
- **Gestion des pièces justificatives** : Ajoutez des documents liés aux dossiers pour servir de preuves ou de documents de support.

## Modèles de base de données

Les principales tables utilisées dans l'application incluent :

- `users` : Contient les informations des utilisateurs du système (magistrats, secrétaires, etc.)
- `parties` : Contient les informations des plaignants et des accusés.
- `plaintes` : Stocke les plaintes avec des références aux parties impliquées.
- `dossiers` : Gère les dossiers associés aux plaintes.
- `audiences` : Gère les audiences planifiées dans le cadre d'un dossier.
- `jugements` : Contient les jugements rendus pour les dossiers.
- `pieces` : Gère les pièces justificatives associées à un dossier.

## Installation

1. Clonez le dépôt sur votre machine locale :
   ```bash
   git clone https://github.com/votre-utilisateur/gestion-plaintes-parquet.git
   ```

2. Installez les dépendances PHP :
   ```bash
   cd gestion-plaintes-parquet
   composer install
   ```

3. Copiez le fichier `.env.example` et renommez-le en `.env`, puis configurez vos informations de base de données et autres configurations :

   ```bash
   cp .env.example .env
   ```

4. Générez la clé d'application :
   ```bash
   php artisan key:generate
   ```

5. Exécutez les migrations de la base de données :
   ```bash
   php artisan migrate
   ```

6. Lancez le serveur de développement :
   ```bash
   php artisan serve
   ```

L'application sera disponible à l'adresse `http://localhost:8000`.

## Modèles de données

### `users`

| Colonne         | Type     | Description                                   |
|-----------------|----------|-----------------------------------------------|
| id              | integer  | Identifiant unique de l'utilisateur           |
| name            | varchar  | Nom de l'utilisateur                          |
| email           | varchar  | Email de l'utilisateur                        |
| role            | varchar  | Rôle de l'utilisateur (magistrat, secrétaire) |

### `plaintes`

| Colonne        | Type     | Description                                  |
|----------------|----------|----------------------------------------------|
| id             | integer  | Identifiant unique de la plainte             |
| motif          | varchar  | Motif de la plainte                          |
| plaignant_id   | integer  | Référence à l'identifiant du plaignant       |
| accusee_id     | integer  | Référence à l'identifiant de l'accusé        |
| magistrat_id   | integer  | Référence à l'utilisateur (magistrat)        |

### `dossiers`

| Colonne         | Type     | Description                                  |
|-----------------|----------|----------------------------------------------|
| id              | integer  | Identifiant unique du dossier                |
| nom             | varchar  | Nom du dossier                               |
| date_ouverture  | date     | Date d'ouverture du dossier                  |
| plainte_id      | integer  | Référence à l'identifiant de la plainte      |

### `audiences`

| Colonne     | Type     | Description                                  |
|-------------|----------|----------------------------------------------|
| id          | integer  | Identifiant unique de l'audience             |
| date        | datetime | Date de l'audience                           |
| lieu        | varchar  | Lieu de l'audience                           |
| statut      | varchar  | Statut de l'audience (programmée, renvoyée)  |

### `jugements`

| Colonne     | Type     | Description                                  |
|-------------|----------|----------------------------------------------|
| id          | integer  | Identifiant unique du jugement               |
| date        | datetime | Date du jugement                             |
| description | varchar  | Description du jugement                      |
| statut      | varchar  | Statut du jugement (conclue, en cours)       |

## Tests

Pour exécuter les tests, utilisez la commande suivante :

```bash
php artisan test
```

## Contributions

Les contributions sont les bienvenues. Veuillez soumettre vos propositions via des pull requests.

## License

Cette application est sous licence MIT. Consultez le fichier [LICENSE](LICENSE) pour plus d'informations.
```

Ce fichier `README.md` présente les principales fonctionnalités de l'application, la structure de la base de données, ainsi que les instructions d'installation et d'utilisation.
