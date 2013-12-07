PP Project
==========

Didakticna spletna igra za ucenje zgodovine.

Navodila za namestitev:
-----------------------

git clone git@github.com:jurebajt/pp_project.git
cd pp_project
composer install

Vzpostavitev podatkovne baze:
-----------------------

nastavi root uporabnika -> username: root, password: root
ustvari bazo z imenom 'pp_project' in collation 'utf8_unicode_ci'
php artisan migrate:install (v bazi ustvari tabelo, ki je potrebna za izvajanje migracij)
php artisan migrate (bazo preko migracij posodobi na zadnjo verzijo)
php artisan db:seed (bazo napolni s testnimi podatki, ki so definirani v /app/database/seeds/*.php)