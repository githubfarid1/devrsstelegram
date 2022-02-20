## Installation ke server
- composer require laravel/ui
- php artisan ui bootstrap --auth
- npm install && npm run dev
- composer require jeroennoten/laravel-adminlte
- php artisan adminlte:install
- composer require laravel/fortify
- php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
- tambahkan di config.php/app.php :  App\Providers\FortifyServiceProvider::class,
- update app/Actions/Fortify/UpdateUserPassword.php validateBag jadi validate()
 
## Cara membuat table many to many
- gabungan dari 2 table yang direlasikan
- nama table harus berurutan sesuai abjad
- contoh: table sales dan books namanya jadi books_sales karena b lebih awal dari s
- foreign key juga berurutan yaitu book_id dan sale_id
  
