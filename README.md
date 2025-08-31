## Setting up the application
- Run `composer install`
- Run `npm install`
- Run `npm run dev`
- Run `php artisan serve` in a new terminal to start php server
- Run `php artisan queue:work` in a new terminal to start the queue workers
- Run `php artisan reverb:start` to start the broadcasting server in a new terminal

## Running the application
- `http://localhost:8000/pos/send-update` to send new pizza updates
- `http://localhost:8000/pos/updates` to view live status updates

>You will need to register first on the app before accessing any of the pages.