#### Instrukcja instalacji.

*Testowane na Linux Ubuntu 20.04 LTS.*

Zainstalowanie cli php:

```
sudo apt install php7.4-cli
```

Informacyjnie: sprawdzenie wersji php:

```
php -v
```

Zainstalowanie composera:

```
sudo apt install composer
```

Zainstalowanie simple xml:

```
sudo apt install php7.4-xml
```

Zainstalowanie gita:

```
sudo apt install git
```

Zainstalowanie phpunit:

```
sudo apt install phpunit
```

Pobranie repozytorium z github:

```
git clone https://github.com/pkochany/RssToXmlDownload.git
```

Wejście do katalogu:

```
cd RssToXmlDownload
```

Instalacja pakietów composera:

```
composer install
```

Użycie jednego z 2 poleceń:

```
php src/console.php csv:simple <URL> <SRC>
```

lub

```
php src/console.php csv:extended <URL> <SRC>
```

testowanie

```
vendor/bin/phpunit
```

zakładam że kolumna creator ma zawierać treść itemu RSS.
