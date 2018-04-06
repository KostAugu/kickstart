![](https://avatars0.githubusercontent.com/u/4995607?v=3&s=100)

NFQ Akademija
============

# Intro

Sveiki! Tai yra Jūsų startinis projekto "template". 
Šioje repositorijoje rasite Symfony `4.0.6` minimalų projekto paketą su jau paruoštais 
visais reikalingais failais ir įrankiais darbui:
 
- Lokalaus development'o aplinka (docker) (PHP 7.2, MySql DB, Nginx)
- Pradinis bundle (AppBundle) kartu su stiliaus failais.
- Įdiegtas bootstrap
- Asset'ų buildinimas (npm, yarn, sass)
- Travis CI template


# Paleidimo instrukcija

Metai iš metų studentai maldavo jog galėtų dirbti su Windows'ais akademijos metu.
 Bet nepaisant nieko, tolerancijos ir palaikymo Windows operacinei niekada nebuvo ir nebus.  

> Perspėjimas: Itin kieti profesionalai nenaudoja niekam tikusių operacinių sistemų. 

### Reikės dokerio

Naudosime naujausią dokerio versiją, kuri įgalina virtualizaciją be Virtualbox ar Vmware.
 Tam reikės, kad jūsų kompiuterio procesorius palaikytų [Hypervisor](https://en.wikipedia.org/wiki/Hypervisor).
 Nėra dėl ko nerimauti, dabartiniai kompiuteriai kone visi turi šį palaikymą.

Parsisiunčiate ir įsidiegiate įrankį iš [čia](https://docs.docker.com/install/linux/docker-ce/ubuntu/). Iškart įdiegus reikia pasidaryti, kad `docker` būtų galima naudoti be root teisių, kaip tai padaryti rasite [čia](https://docs.docker.com/compose/install/).

Parsisiunčiate ir įsidiegiate `docker-compose` iš [čia](https://github.com/docker/compose/releases).

Taip pat reikia įsidiegti [Kitematic](https://github.com/docker/kitematic/releases).
 Šis įrankis padės geriau organizuoti dokerio konteinerius. 

#### Versijų reikalavimai
* docker: `18.x-ce`
* docker-compose: `1.20.1`


### Projekto paleidimas (projekto kūrimui lokaliai)
Parsisiunčiate šią repositoriją. Taip taip, viršuje kairėje rasite žalią mygtuką ant kurio parašyta "Download", tada pasirenkate zip failo parsisiuntimą.
 
> Akademijos projektui nereikia forkinti, klonuoti ar dar išrasti kokių nors kitų veiksmų, tik parsisiųsti.
 
Extractinat turinį į savo mėgstamą projektų direktoriją.

Einate į šią direktoriją su terminalu. Paprastai bus komanda `cd <path>`.

Susikuriate projekto viduje `.env` failą. Failą užpildote turiniu pateiktu iš `env.dist`.

* Pasiruoškite infrastruktūrą:
  * Pasileidžiame:
  ```
  docker build .docker/php -t php.symfony 
  docker build .docker/frontend/ -t frontend.symfony
  docker-compose -f .docker/docker-compose.yml up -d
  ```
  (jei infrastruktūra nekeičiama, antrą kartą užteks tik `docker-compose -f .docker/docker-compose.yml up -d`)

#### Pasruošiame frontend aplinką

* JavaScript/CSS įrankiams (atsidaryti atskirame lange)
```
docker-compose -f .docker/docker-compose.yml run --rm frontend.symfony
```
  * Pirmą kartą (įsirašome JavaScript bilbiotekas)
  ```
  npm install --no-save
  ```
  * Jei pakeitimai neatsinaujina:
  ```
  yarn run encore dev --watch
  ```

#### Pasruošiame backend aplinką

* Jei pasiruošinėjote Frontend aplinką, atsidarykite naują `terminal`/`bash` langą (nebe docker konteineryje)
```
exit
```

* PHP įrankiams (atsidaryti atskirame lange)
```
docker exec -it php.symfony bash
```
  * Pirmą kartą paleidus (įsirašome PHP biliotekas):
  ```
  composer install
  ```
  * Jei pakeitimai neatsinaujina:
  ```
  bin/console --env=dev cache:clear
  bin/console --env=dev cache:warmup
  bin/console --env=dev assets:install
  ```

* Pasižiūrime rezultatą.
Atsidarome naršyklėje [symfony.local](http://symfony.local)


### Projekto paleidimas (palyginimui kaip atrodytų produkcinėje)

* Pasiruoškite infrastruktūrą:
  * Pasileidžiame:
  ```
  docker build .docker/php -t php.symfony 
  docker build .docker/frontend/ -t frontend.symfony
  docker-compose -f .docker/docker-compose.yml up -d
  ```
  (jei infrastruktūra nekeičiama, antrą kartą užteks tik `docker-compose -f .docker/docker-compose.yml up -d`)

#### Pasruošiame frontend aplinką

* JavaScript/CSS įrankiams (atsidaryti atskirame lange)
```
docker-compose -f .docker/docker-compose.yml run frontend.symfony
```
  * Pirmą kartą (įsirašome JavaScript bilbiotekas)
  ```
  npm install --no-save
  ```
  * Jei pakeitimai neatsinaujina:
  ```
  yarn run encore production
  ```
  
#### Pasruošiame backend aplinką

* PHP įrankiams (atsidaryti atskirame lange)
```
docker exec -it php.symfony bash
```
  * Pirmą kartą paleidus (įsirašome PHP biliotekas):
  ```
  composer install
  ```
  * Jei pakeitimai neatsinaujina:
  ```
  bin/console --env=prod cache:clear
  bin/console --env=prod cache:warmup
  bin/console --env=prod assets:install
  ```

* Pasižiūrime rezultatą.
Atsidarome naršyklėje [symfony.prod](http://symfony.prod)

P.S. šalia galima atsidaryti ir palyginti su `symfony.local`


### Kaip teisingai išjungti docker konteinerius?

Išjungiama su komanda:
```
docker-compose -f .docker/docker-compose.yml kill
```

Galima išjungti ir po vieną:
```
docker-compose -f .docker/docker-compose.yml kill <container name>
```


### Kaip pamatyti kas atsitiko?

Atsidarote naršyklę ir einate į `http://127.0.0.1:8000`,
 jei nematote užrašo "NFQ Akademija", reiškia, kažkur susimovėte,
 tokiu atveju viską ištrinat ir kartojate iš naujo tol kol gausis.
 Kai prarasite visiškai viltį, kreipkitės į [Google](http://lmgtfy.com/?q=docker+is+not+working), o po to į mentorių.  

### Kaip prisijungti prie MySql duomenų bazės?

```
mysql -uroot -h<MYSQL_IP_ADRESAS> --port=3307 -p
```
Kur vietoj `MYSQL_IP_ADRESAS` rasite per `docker inspect mysql.symfony | grep IPAddress`

Slaptažodžiui naudoti `p9iijKcfgENjBWDYgSH7` (toks pats, kaip ir [.docker/docker-compose.yml](.docker/docker-compose.yml) `MYSQL_ROOT_PASSWORD=`)

### Kaip pasiruošti produkcinei aplinkai?

* Pasikeiskite slaptažodžius: ieškokite failuose reikšmių prie `DATABASE_URL=` ir `APP_SECRET=` 

### Troubleshooting'as

Jeigu kažkas nutiko ne taip, na, atsirado raudona eilutė, ar tiesiog nutrūko ir nieko nerodo, neatsidaro naršyklėje svetainė, tai pirmas žingsnis būtų paleisti komandą:

```
docker-compose -f .docker/docker-compose.yml logs 
```

Nepamirškite, kad galima nurodyti norimą procesą. Taip pat ir 'grepinti'.

```
docker-compose -f .docker/docker-compose.yml logs mysql.symfony
```

### Feedbackas

Jeigu taip nutiktų, kad repositorijoje, projekto template ar instrukcijoje rastumėte klaidą, tai nesišnibždėkite vieni tarp kitų, o sukurkite "issue". 
O jei atidarysite "pull requestą" su fixu, gausite iškart 1000 karmos taškų.
