# introduce

<h5>task vhi-web di build menggunakan framework laravel versi 10 dengan versi php 8.2, jadi pastikan versi php yang anda gunakan sudah sesuai</h5>

<h5>
aktifkan require module php yang dibutukan untuk menjalankan framework tersebut, beberapa modul yang di harus di aktifkan ialah pdo_mysqli, mysqli, xml  dan mbstring, zip, dan curl
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

# Start Local Development Server Ngandre API

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

# Endpoint Auth API

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

# Access Ke Endpoint API Yang Menggunakan Session

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

# Endpoint API Master Data PHOTOS, like dan unlike photos

#api tersebut mempunyai endpoint yang sama tetapi dibedakan berdasarkan request method
#:id yang dimaksud ialah id photos
{{base_url}}/api/v1/photos -> GET (menampilkan list photo) AUTH: NO
{{base_url}}/api/v1/photos/:id -> GET (menampilkan detail photo) AUTH: NO
{{base_url}}/api/v1/photos -> POST (menambah data photo) AUTH:YES
{{base_url}}/api/v1/photos/:id -> PUT (mengubah data photo) AUTH:YES
{{base_url}}/api/v1/photos/:id -> DELETE (menghapus data photo) AUTH:YES
{{base_url}}/api/v1/photos/:id/like -> POST (menghapus data photo) AUTH:YES
{{base_url}}/api/v1/photos/:id/unlike -> POST (menghapus data photo) AUTH:YES

```

# link collection

```bash
#tinggal di import di postman
https://drive.google.com/file/d/1Ud7wVNzm8HdfBC9hsMZ9b1PJbkMR5hJv/view?usp=sharing
```

# response list photos

```json
{
    "message": "Successfully Data",
    "data": [
        {
            "id": 4,
            "name": "foto samsul",
            "caption": "kerja",
            "tags": "photos",
            "img": "images/EdVXabBcxFx47EyA6KHtmOx4NHt0qW9xBWwIKzAY.png",
            "users_id": 3,
            "created_at": "2023-06-09T04:57:18.000000Z",
            "updated_at": "2023-06-09T04:57:18.000000Z",
            "like": [ #object like berisikan list orang-orang yang memberikan like untuk foto tersebut
                {
                    "id": 33,
                    "photos_id": 4,
                    "users_id": 1,
                    "created_at": "2023-06-09T04:57:48.000000Z",
                    "updated_at": "2023-06-09T04:57:48.000000Z"
                }
            ]
        }
    ]
}
```
