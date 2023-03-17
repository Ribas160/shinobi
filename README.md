# Description
Simple CRUD application.

The application is only available to users with Israeli IP addresses.

# Installation

### Clone repository
```
git clone https://github.com/Ribas160/shinobi.git
```

### Install dependencies
```
composer update
```
```
npm install
```

### Create .env file and configure your environment variables
```
cp .env.example .env
```

### Generate app key
```
php artisan key:generate
```

### Run migrations
```
php artisan migrate
```

### Run tests
```
php artisan test
```

### Seed database
```
php artisan db:seed
```
