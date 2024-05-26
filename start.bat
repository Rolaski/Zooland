%systemDrive%\xampp\mysql\bin\mysql -uroot -e "CREATE DATABASE IF NOT EXISTS zooland_db;"

if %errorlevel% neq 0 msg %username% "Nie udalo sie utworzyc bazy danych." && exit /b %errorlevel%

php -r "copy('.env.example', '.env');"

powershell -Command "(Get-Content .env) -replace 'DB_CONNECTION=.*', 'DB_CONNECTION=mysql' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_HOST=.*', 'DB_HOST=127.0.0.1' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_PORT=.*', 'DB_PORT=3306' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_DATABASE=.*', 'DB_DATABASE=zooland_db' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_USERNAME=.*', 'DB_USERNAME=root' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_PASSWORD=.*', 'DB_PASSWORD=' | Set-Content .env"

call composer install

call php artisan migrate

call php artisan db:seed

call php artisan key:generate

call php artisan storage:link

npm install
if %errorlevel% neq 0 (
    msg %username% "Nie udalo sie zainstalowac zaleznosci npm"
    exit /b %errorlevel%
)

npm install -D tailwindcss postcss autoprefixer flowbite
if %errorlevel% neq 0 (
    msg %username% "Nie udalo sie zainstalowac Tailwind CSS i Flowbite"
    exit /b %errorlevel%
)

npm install apexcharts
if %errorlevel% neq 0 (
    msg %username% "Nie udalo sie zainstalowac ApexCharts"
    exit /b %errorlevel%
)

code .
