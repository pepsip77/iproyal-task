# IProyal task
## Description

Your task is to create a Laravel-based API for a digital wallet service that stores use
information and three types of transactions:
* Order: user orders an item and pays for it using the wallet balance.
* Deposit: user deposits money into their wallet balance.
* Refund: user requests a refund for a previous order.

### Requirements
* The API should be implemented using Laravel and MySQL.
* The database schema should be designed to store wallet transactions and user
information.
* The project has to have a method to populate database with 700 fake users and 1
million random transactions (order, deposit, refund). All transactions should be in
USD currency.
* The following endpoints has to be provided:
  * /statistics: Endpoint for retrieving statistics about the wallet transactions.

* The statistics endpoint should accept the following information as a filters:

  * date_from
  * date_to
  * user_id
  * currency_abb (i.e EUR, USD, GBP, AUD etc.)

* The statistics endpoint should return the following information:

  * Total number of transactions.
  * Total amount of money deposited into the wallet.
  * Total amount of money spent on orders.
  * Total amount of money refunded.
  * Average transaction amount in USD
  * Average transaction amount in given currency_abb.

    * Use any free API for currency rates of your choice.
    * Use the latest currency rates for all currency conversions.
    * If currency_abb is not provided, it should not be included in the
    response.

* Number of transactions per transaction type (order, deposit, refund).
* The code has to be covered with automated tests

### Bonus points:
* Implement caching to improve performance
* Implement API authentication, preferably using JWT or OAuth.
* Implement validation on the endpoint request

## Running the app

### Requirements
- PHP 8.1
- Composer

### How to run
- Run ```composer install```
- Fill .env file based on .env.example
- Run project using ```php artisan serve```
