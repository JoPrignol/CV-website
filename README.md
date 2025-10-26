composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate

npm run dev

php artisan serve


Créer un admin en DB : 

php artisan tinker

App\Models\User::create([
  'name' => 'John Doe',
  'email' => 'john@example.com',
  'password' => bcrypt('secret'),
]);

(ou : php artisan make:filament-user)

Se connecter sur 'http://localhost:8000/admin'


TODO: 

https://www.notion.so/28866f51609e806aa26af815b9887a6d?v=28866f51609e80bb8e1e000c3b782143&source=copy_link
