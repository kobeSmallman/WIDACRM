<p>
Setup without using Apache (fine for development, not fine for production): 


Downloaded composer, Node.js, Git, php (from the web)

When you copy repository from github, when you open it in your IDE, open terminal you will see your path to your Laravel root folder. 

After, in that IDE terminal in the project location, you want to do install composer 
	To do this: 
		composer install 
 also for npm install vite --save-dev
After, You will need to generate the application key 
	to do this: 
		php artisan key:generate

You will see your own key on your own device, in the .env: 
	it will look like this: 
		APP_KEY=base64:JNF2WNO5MP6WMP3OMQF4QMOIWMO499M=
			(that's an exmaple APP_KEY, this will be different on everyones computer)
	Test by doing the following in the same terminal: 

	Also check this in your php.ini file to make sure it is enabled (around line 943/944) 
			extension=pdo_mysql
		php artisan serve



---------------------------------------------------------------------------------------------------------------------------------------

				Apache setup: 
//not ready yet so do not follow these instructions yet.

Install WAMP (if not already done)
After installation is complete
When you copy repository from github to WAMP folder (within the /www/ under the WAMP install)
When you open it in your IDE, open terminal you will see your path to your Laravel root folder. 
	-Tell apache where to direct those requests. 
		For production when we use Apache, we will use these steps: 
	in your Httpdconf example for Tony as the example, yours will be a different path (probably):
		<Directory "C:\USers\student\Desktop\WIDA\WIDACRM\public\">
			Allowoverride none
			Require all granted
		</Directory>
After, You will need to generate the application key (if you are using a new device, (if you are not using your VM anymore that counts as a new device)) 
	to do this: 
		php artisan key:generate 
	
	
Change two files, first your .env: 
	add "http:/localhost/laravel"  (replace the application url to whatever your alias is or your full path)

Then Under the config/app.php 
	add "http:/localhost/laravel" (replace the application url to whatever your alias is or your full path)

Also add a .htaccess to your laravel root path. 
	We are putting this into that file: 
		<IfModule mod_rewrite.c>
		RewriteEngine On
		RewriteCond %{REQUEST_URI} !/
		ReqriteRule ^(.*)$ /$1 [L]
		</IfModule>
If you want to set up an alias do the followin, if not skip this step : 
				This example makes it so that you can just put localhost/WIDACRM
	Alias /WIDACRM "C:\USers\student\Desktop\WIDA\WIDACRM\public\
	



</p>


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
