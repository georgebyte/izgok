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

1. nastavi root uporabnika -> username: root, password: root
2. ustvari bazo z imenom 'pp_project' in collation 'utf8_unicode_ci'
3. php artisan migrate:install (v bazi ustvari tabelo, ki je potrebna za izvajanje migracij)
4. php artisan migrate (bazo preko migracij posodobi na zadnjo verzijo)
5. php artisan db:seed (bazo napolni s testnimi podatki, ki so definirani v /app/database/seeds/*.php)