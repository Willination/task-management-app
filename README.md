# Instructions

## Local Setup

1. unzip file.
2. run:

```
composer install
npm install 
npm run dev
```
3. run
(This generates bootstrap 5 files):
```
npm build run
```

4. run (Optional)
```
php artisan optimize
php artisan route:clear
php artisan optimize:clear
```
5. create a empty mysql database

```
CREATE DATABASE  task_management;
```
6. Run database migrations:

```
php artisan migrate
```
7. Start application with ```php artisan serve```
