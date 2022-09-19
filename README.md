# https://docs.google.com/document/d/e/2PACX-1vS3dPA9WfKqLpD92trfivQI3-llf6W8d5S55rFT1-PdUFx5YuRfMYjjGmf8PrQQuld5q_6RzlaKudkY/pub
Built with Laravel and Laravel Sail

NOTE: Please Make sure your Docker is up and running before you run this project.

1. clone the repo `git clone https://github.com/timurrodya/transactions-app.git`
2. cd into the project root folder
3. run `php artisan sail:install`
4. To install the dependencies run `composer install`
5. Run the server `./vendor/bin/sail up`
6. Migrate the database `./vendor/bin/sail artisan migrate`
7. Seed database `./vendor/bin/sail artisan db:seed`
