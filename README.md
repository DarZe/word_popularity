# WORD POPULARITY

Ovaj projekt računa popularnost upisane riječi koristeći određeni provider

# ALATI ZA INSTALACIJU

XAMPP, MySQL, PHP, COMPOSER 

# INSTALACIJA

Preuzmi repozitorij word_popularity i izvezi u folder htdocs koji je kreiran nakon instalacije XAMPP-a.
Preimenuj folder word_popularity-master u word_popularity.
U MYSQL bazi pokrenuti skriptu htdocs/word_popularity/database/word_popularity.sql
Kreirat će se baza "search_project".
Otvori folder htdocs/word_popularity/application/config i u file-u database.php unesi username i password za svoju bazu podataka.

Pokreni konzolu i otvori htdocs/word_popularity, te unesi naredbu "composer install".

Otvori preglednik i upisi localhost/word_popularity

# API

Nakon pokretanja url-a http://localhost/word_popularity/index.php/Search_word/get_word?term=word&provider=github

ispisat će se: 

term	"word"
score	7.13

Ukoliko se upiše novi provider koji nije kreiran u bazi, preglednik će izbaciti grešku.
npr.

http://localhost/word_popularity/index.php/Search_word/get_word?term=word&provider=githubs

rezultat:

message	
provider	"Unsupported provider!"

Primjer za unos riječi lenovo:

api: http://localhost/word_popularity/index.php/Search_word/get_word?term=lenovo&provider=github
rezultat: 

term	"lenovo"
score	4.44
