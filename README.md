## About LaraTrade

LaraTrad is a web application to track your stocks and cryptos. You can track your day-to-day trades and your net worth growth, having a clear picture of your transactions. Some of the features that this app will offer you such as:

- Adding all your buys and sells, deposits and withdrawals.
- Converting your money between CAD and USD and vice versa.
- Track your actual gain/loss on specific stock/crypto.
- Statistics and charts show your actual gains/losses and net worth.
- and more...

## Installing the app

```php 
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```
#### Admin User
Username: administrator

Password: password

#### User:
Username: johndoe

Password: password

## License

The LaraTrad is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
