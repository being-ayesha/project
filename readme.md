<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Project Instruction

- Step 1: Download Project from [Click Download]( https://code.myworkforce.com/TechVillage/rocketr-clone-project.git).
- Step 2: Got to project file location and run command : composer update. 
- Step 3: Create a databse in your phpMyadmin
- Step 4: Rename .env.example to .env and change details from .env file.
	- DB_DATABASE=your_database_name
	- DB_USERNAME=your_database_username
	- DB_PASSWORD=your_database_password
- Step 5: Run Command : php artisan migrate.
- Step 6: Run Command : php artisan db:seed.

## CreationShop SDK

Download Creationshop SDK from [Open File]( https://code.myworkforce.com/TechVillage/rocketr-clone-project/Creationshop-SDK).

## Initialize The Path

- Step 1: require_once realpath(__DIR__ . '/../') . '/init.php';

## Set API Crediential 

- Step 2: \Creationshop\Creationshop::setApiHandler('your_application_id','your_application_secret');

## Get Order List

This endpoint is used to retreive a list of all orders.

	$o = new Creationshop\Order();
	print_r($o->getOrders());

## Get Specific Order Details

This endpoint is used to retreive specific information about an order.

	$o = new Creationshop\Order();
	print_r($o->getOrders('your_orders_id'));

## Order Create 

This will create an invoice and order and return the payment details.


	$o = new Creationshop\Order();
 	$o->setAmount(50);
 	$o->setBuyerEmail('shakil.techvill@gmail.com');
 	$o->setPaymentMethod(1);
 	$o->setCurrency(1);
 	$result = $o->createOrder();

 	echo 'Please send  Amount:' . $result['paymentInstruction']['amount']  .'Currency:'. $result['paymentInstruction']['currency'] . ' to ' . $result['paymentInstruction']['link'];


## Get Invoice List

This endpoint is used to retreive a list of all invoices.

	$i = new Creationshop\Invoice();
	print_r($i->getInvoice());


## Get Invoice Specific Details

This endpoint is used to retreive specific information about an invoices. 

	$i = new Creationshop\Invoice();
	print_r($i->getInvoice('your_invoice_id'));

## Create Invoice

This will create an invoice and respond with the invoice identifier and a link to the checkout page.

	$i = new Creationshop\Invoice();
 	$i->setAmount(10);
 	$i->setQuantity(1);
 	$i->setBuyerEmail('shakil.techvill@gmail.com');
 	$i->setPaymentMethod(1);
 	$i->setCurrency(1);
 	$i->setbrowserRedirect('https://rocketr.techvill.net');
 	$result = $i->createInvoice();
 	echo "Please visit click the following link to pay the invoice: " . $result['link']. "\n";

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
