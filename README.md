## About TEST-JTI

Repository TEST-JTI merupakan jawaban rangkaian seleksi kemampuan untuk rekruitmen PT JTI/JNI.

## Petunjuk Penggunaan

1. Run git clone https://github.com/ftrasyiid/test-jti.git
2. Run composer install
3. Run cp .env.example .env or copy .env.example .env
4. Modify DATABASE configuration ( DB_DATABASE, DB_USERNAME, DB_PASSWORD ) in .env
5. Add GOOGLE_CLIENT_ID which i gave through email to .env
6. Add GOOGLE_CLIENT_SECRET which i gave through email to .env
7. Add FEBRI_KEY which i gave through email, this is the key used on encryption to .env
8. Run php artisan key:generate
9. Run php artisan migrate
10. Run php artisan serve
11. Go to link localhost:8000 OR 127.0.0.1:8000