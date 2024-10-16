<p align="center"><a href="https://marksense.tech" target="_blank"><img src="https://raw.githubusercontent.com/dewantaratirta/marksense/dbaf7cbe165b57e83131df219d42188b52415a9b/public/assets/img/marksense.svg" width="400" alt="Laravel Logo"></a></p>

## About Marksense

Marksense is a cutting-edge platform that ensures transparency in trading profit and loss (PnL) reporting by leveraging blockchain technology. Built on Base and integrated with zkFetch and Binance, Marksense verifies every PnL on-chain, providing accurate, real-time insights into Key Opinion Leaders (KOLs) trading performance. No more inflated numbers or misleading data—just fully verifiable PnL that you can trust.

## Technology Stack

Marksense is built using a modern and robust tech stack to ensure high performance and security. The backend is powered by Laravel, providing a solid foundation for API handling and data management. For the frontend, we use Svelte, delivering fast and interactive user experiences with minimal overhead. zkFetch is integrated to bring advanced cryptographic proofs, ensuring on-chain verification of PnL data. The platform also leverages the Binance API for real-time trade data and integrates Coinbase Wallet to offer users seamless and secure access to blockchain functionality.


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
