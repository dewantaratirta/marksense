<p align="center"><a href="https://marksense.tech" target="_blank"><img src="/public/assets/img/marksense.svg" width="400" alt="Laravel Logo"></a></p>

## About Marksense

Marksense is a cutting-edge platform that ensures transparency in trading profit and loss (PnL) reporting by leveraging blockchain technology. Built on Base and integrated with zkFetch and Binance, Marksense verifies every PnL on-chain, providing accurate, real-time insights into Key Opinion Leaders (KOLs) trading performance. No more inflated numbers or misleading data—just fully verifiable PnL that you can trust.

## Requirements

- PHP >= 8.2
- Composer 2.5.8
- Node >= 20
  
## Installation

Copy .env and php dependencies

```
cp .env.example .env
composer install
```

Create database and run this code

```
php artisan migrate:fresh --seed
```

Install javascript dependencies

```
npm install -g yarn
yarn install
```

## Start local server

```
php artisan serve
```

```
yarn dev
```


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
