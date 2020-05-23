<img src="https://ecrcentral.org/images/ecrcentral-logo.png" width="350px">
A central platform for early career researchers and postdocs to find opportunities to fund their research and also to share experiences and to provide feedback.

### Installation steps

ECRCentral is build with PHP using [Laravel](http://laravel.com/) 5.5.x with [Bootstrap](http://getbootstrap.com) 4.0.x. The authentication system is build upon [Laravel Auth](https://github.com/jeremykenedy/laravel-auth)


Use the following steps to install the App:

1. Run `git clone https://github.com/ecrcentral/ECRCentral.git ECRCentral`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -psecret```
    * ```create database ecrcentral;```
    * ```\q```
3. Go to the projects home dir using `cd ECRCentral` and run `cp .env.example .env`
4. Configure your `.env` file by adding MySQL database details 
5. Run `composer update` from the projects root folder
6. From the projects root folder run:
7. From the projects root folder run `sudo chmod -R 755 ../ECRCentral`
8. From the projects root folder run `php artisan key:generate`
9. From the projects root folder run `php artisan migrate`
10. From the projects root folder run `composer dump-autoload`
11. From the projects root folder run `php artisan db:seed`
12. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn).

#### Build the Front End Assets

##### Using Artisan:
1. From the projects root folder run `php artisan serve`

##### Using NPM:
1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`
  * You can watch assets with `npm run watch`

##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

#### Optionally Build Cache
1. From the projects root folder run `php artisan config:cache`



#### Homepage screenshot 
<img src="https://raw.githubusercontent.com/asntech/ECRCentral/master/screenshots/home.png" width="100%">

The portal will be available on http://ecrcentral.org/ For more check the screenshots folder.
