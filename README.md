# Kata TDD

## Installation
```bash
git clone https://github.com/Devs-Iteracode/kata-employee-reporte.git
cd kata-employee-reporte

# Installe les dépendances avec Composer (via une image Docker)
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# Initialise la config pour l’environnement local
cp .env.example .env

# Ajoute une clé (APP_KEY) à la config
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    php artisan key:generate

# Lance l’application (avec Docker Compose)
./vendor/bin/sail up
```
## Lancer les tests

```cmd
./vendor/bin/sail test
```
