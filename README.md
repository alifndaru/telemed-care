Php = 8.3

Postgres sql = 16

Clone repo https://github.com/alifndaru/telemed-care.git

## Open terminal

cp .env.example .env

edit env

```bash
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=postgres
DB_PASSWORD=
```

# Di dalam CMD/Terminal

composer install

npm install

php artisan key:generate

php artisan migrate

```
php artisan db:seed --class=IndoRegionProvinceSeeder
php artisan db:seed --class=IndoRegionRegencySeeder
php artisan db:seed --class=IndoRegionDistrictSeeder
php artisan db:seed --class=IndoRegionVillageSeeder
```

# membuat account admin

`php artisan make:filament-user`

`php artisan shield:setup (`

![Screenshot 2024-12-09 at 12.38.54.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/054c31a4-1d06-4080-883c-1a893d61d600/6da95a9c-b1e4-4af1-9ef4-7bac3dc984b1/Screenshot_2024-12-09_at_12.38.54.png)

![Screenshot 2024-12-09 at 12.39.34.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/054c31a4-1d06-4080-883c-1a893d61d600/adb03b95-5e6c-4558-9390-d3831d4250c3/Screenshot_2024-12-09_at_12.39.34.png)

)

`php artisan shield:install admin`

php artisan shield:generate —-all

![Screenshot 2024-12-09 at 12.40.31.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/054c31a4-1d06-4080-883c-1a893d61d600/7b8200da-7e55-4ec4-82fb-74d4ab9236e8/Screenshot_2024-12-09_at_12.40.31.png)

php artisan shield:super-admin =  ituu untuk membuat user role super-admin  Creates Filament Super Admin

# Running project

npm run dev

php artisan serve

**keynote : untuk membuat role ketika membuka menu role tidak perlu mengubah apapun isi nya cukup menambahkan saja, panduan pertama membuat role yaitu role nya itu  :** 

**dokter lalu klinik**

Setup selesai
