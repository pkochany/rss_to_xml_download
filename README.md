#### Instalation.

*Testing on Linux Ubuntu 20.04.*

Install PHP cli:

```
sudo apt install php7.4-cli
```

Make sure it was properly installed:

```
php -v
```

Install composer:

```
sudo apt install composer
```

Install simple xml:

```
sudo apt install php7.4-xml
```

Install git:

```
sudo apt install git
```

Install phpunit if you want to run tests:

```
sudo apt install phpunit
```

Download repository:

```
git clone https://github.com/pkochany/rss_to_xml_download.git
```

Enter the location:

```
cd rss_to_xml_download
```

Install composer packages:

```
composer install
```



#### Usage.

You can use one of two commands. "simple" will overwrite existing csv file:

```
php src/console.php csv:simple <URL> <SRC>
```

"extended" will append to the existing csv file.

```
php src/console.php csv:extended <URL> <SRC>
```

Testing:

```
vendor/bin/phpunit
```

My sample command I wrote for testing using random rss sample feed:

```
php src/console.php csv:simple https://feedforall.com/sample.xml ~/Pobrane/test.csv
```

