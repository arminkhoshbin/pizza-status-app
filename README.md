## Setting up the application
- Run `composer install`
- Run `npm install`
- Run `npm run dev`
- Run `php artisan serve` in a new terminal to start php server
- Run `php artisan queue:work` in a new terminal to start the queue workers
- Run `php artisan reverb:start` to start the broadcasting server in a new terminal

## Running the application
- `http://localhost:8000/pos/orders` to view all your orders
- `http://localhost:8000/pos/create-order` to create a new pizza order
- `http://localhost:8000/orders/{orderId}/send-updates` to send new order updates
- `http://localhost:8000/order/updates` to view all order updates

>You will need to register first on the app before accessing any of the pages.