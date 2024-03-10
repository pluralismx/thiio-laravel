INSTALLATION

1. Please create a new directory in you htdocs folder (suggested name thiio-fullstack).
2. Clone this repository there
3. Create a new virtual host with the following fake domain: "thiio.com.devel"
4. Define your CORS config in your Apache's config file (if neccesary).
5. In the main root directory of the project there is a sql file with the database structure, please execute the query in your preffered DB manager
6. Don't forget to run php ```composer install``` command to update all dependencies.

FEATURES

1. Laravel version 8.75
2. Firebase / JWTAuth 3.0.0
3. Encryption type used SHA256

TDD

1. Test file is in tests/unit under UserControllerTest.php
2. Checked all routes to return status 200 to demonstrate TDD functionallity
3. In your preffered Command prompt, please run ```php artisan test``` to see results.

API

Routes are defined in the routes/web.php file. Methods implemented:

1. POST
2. GET
3. PUT
4. DELETE

Mostly all routes require the Authorization header with a valid JWT, nevertheless
to create a new user it is not required, for everything else it is.

Thank you for reading,
Regards, Gerardo





