# introduce

<h5>task vhi-web di build menggunakan framework laravel versi 10 dengan versi php 8.2 dan versi composer 2.5.8, jadi pastikan versi php yang anda gunakan sudah sesuai</h5>

<h5>
aktifkan require module php yang dibutukan untuk menjalankan framework tersebut, beberapa modul yang di harus di aktifkan ialah pdo_mysqli, mysqli, xml  dan mbstring, zip, curl dan sodium
</h5>

```bash
#berikut list lengkap dari module php yang digunakan
[PHP Modules]
calendar
Core
ctype
curl
date
dom
exif
FFI
fileinfo
filter
ftp
gettext
hash
iconv
json
libxml
mbstring
mysqli
mysqlnd
openssl
pcntl
pcre
PDO
pdo_mysql
Phar
posix
random
readline
Reflection
session
shmop
SimpleXML
sockets
sodium
SPL
standard
sysvmsg
sysvsem
sysvshm
tokenizer
xml
xmlreader
xmlwriter
xsl
Zend OPcache
zlib

[Zend Modules]
Zend OPcache


```

# composer run

```Bash
composer install
```

# Start Local Development Server API(laravel) RedComm

```Bash
php -S localhost:8000 -t public || php artisan serve
```

# migrate table db, menjalankan seed dan link storage

```Bash
#migrate datanya
php artisan migrate
# jalankan sedder
php artisan db:seed
# jalankan storage link
php artisan storage:link


# jika ingin rollback table nya jalan kan perintah di bawah ini(optional)
php artisan migrate:rollback

```

# Endpoint Auth API (jika ingin menggunakan fitur AUTH)

```Bash
#baseUrl
localhost:8000 -> sesuaikan dengan base url kalian

#Login
{{base_url}}/api/v1/auth/login ->POST
#register
{{base_url}}/api/v1/auth/register ->POST
#logout
{{base_url}}/api/v1/auth/logout ->POST
#profile dan update profile
{{base_url}}/api/v1/auth/profile ->POST
{{base_url}}/api/v1/auth/profile/update ->POST



```

# Access Ke Endpoint API Yang Menggunakan Session (jika ingin melakukan ini)

<h5>jika ingin mengakses api yang menggunakan session, maka anda harus mengirimkan 2 buah object/param seperti dibawah ini, kirim ketiga buah object tersebut melalui request header</h5>

<h5>Object param yang dikirim lewat request header</h5>

```JSON
{
    "Accept": "application/json",
    "Authorization": "Bearer {{token}}",
}

{{token}} => menggunakan json web token
```

```Bash

# Endpoint API Master Data NOTES, like dan unlike NOTES
# API yang dibuat merupakan api public sehingga aksesnya tidak perlu menggunakan session
#api tersebut mempunyai endpoint yang sama tetapi dibedakan berdasarkan request method
#:id yang dimaksud ialah id NOTES
{{base_url}}/api/v1/notes -> GET (menampilkan list photo) AUTH: NO
{{base_url}}/api/v1/notes/:id -> GET (menampilkan detail photo) AUTH: NO
{{base_url}}/api/v1/notes -> POST (menambah data photo) AUTH:NO
{{base_url}}/api/v1/notes/:id -> PUT (mengubah data photo) AUTH:NO
{{base_url}}/api/v1/notes/:id -> DELETE (menghapus data photo) AUTH:NO

```

# link collection

```bash
#tinggal di import di postman
https://drive.google.com/file/d/142qfn9u75wNfUdo5wfs0myhfwCf8HcDU/view?usp=sharing
```

# unit test notes crud

```bash
php artisan test
```
