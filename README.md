<strong>INSTALLATION</strong>

1. Please create a new directory in you htdocs folder (suggested name: thiio-fullstack).
2. Clone this repository there
3. Create a new virtual host with the following fake domain: thiio.com.devel
4. Define your CORS config in your Apache's config file (if neccesary).
5. In the main root directory of the project there is a sql file with the database structure, please execute the query in your preffered DB manager
6. Don't forget to run php ```composer install``` command to update all dependencies.

<strong>FEATURES</strong>

1. Laravel version 8.75
2. Firebase / JWTAuth 3.0.0
3. Encryption type used SHA256
4. Database MySQL

<strong>TDD</strong>

1. Test file is in tests/unit under UserControllerTest.php
2. Checked all routes to return ```status: 200``` to demonstrate TDD functionallity
3. In your preffered Command prompt, please run ```php artisan test``` to see results.

<strong>API</strong>

Routes are defined in the routes/web.php file. Methods implemented:

1. POST
2. GET
3. PUT
4. DELETE

Most routes require the Authorization header with a valid JWT. However, 
for creating a new user, this header is not necessary, but for all other 
actions, it is. It's important to note that all API calls return a JSON 
response containing the request status. This facilitates front-end 
implementation of the desired app behavior.

<strong>Authentication</strong>

We added to the project the JWTAuth library to generate JSON web tokens to make API calls. To accomplish that task
we created a special folder named "Helpers" in this folder there is a php file named JwtAuth.php which contains
a class where we define 2 methods, one to authenticate the user and another to validate the authorization headers in
the Http request.

The login method checks if the credentials given by the user are valid, if they are we create a small array with the session
details as well with an expiration time for the token. Then we use the JWT's static method ```encode``` to create the token.
Then, we just return the token if it is neccesary, otherwise we just return the user's data.

With this approach we can import this class wherever we need to give authorization to API calls, such in the CRUD for the
CustomerController or for future implematations.

<strong>Final message</strong>

Thank you for reading.
<br/>
<br/>
Regards, Gerardo
<br/>
<br/>
Note: Please don't forget to take a look into the README.md file in the Vue.js repository.





