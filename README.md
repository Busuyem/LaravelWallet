This documentation refers to how to test the api

1) Follow the steps below to ge app running on your local machine
    a. Clone the repo
    b. run composer install/update
    c. open project directory and run cp .env.example .env
    d. run php artisan key:gen
    e. update .env with your database credentials
    f. run php artisan migrate
    g. run php artisan serve

2) Follow these steps to test the api users endpoints
    a. http://127.0.0.1:8000/api/users - add user to the database (POST REQUEST) with the following request data:
        -first_name
        -last_name
        -email
        -password
        -password_confirmation

    b. http://127.0.0.1:8000/api/users - get all the users in the database (GET REQUEST)

    c. http://127.0.0.1:8000/api/users/:id - get details of all the users and their wallets with their associated transactions history

    3. Follow these steps to test the api wallet endpoints
    
    a. http://127.0.0.1:8000/api/wallets - create wallet in the system (POST REQUEST) with the following request data:
        -user_id
        -name
        -type
        -minimum_balance
        -monthly_interest
        -balance
    b. http://127.0.0.1:8000/api/wallets - get all the wallets in the system (GET REQUEST)

    c. http://127.0.0.1:8000/api/wallets/:id - Get wallet details from the systems with the associated transactions history (GET REQUEST)

    d. http://127.0.0.1:8000/api/users/counts - Get users count, count of wallets, total wallet balance, total transaction volume (GET REQUEST)

    e. http://127.0.0.1:8000/api/transactions - send money from one wallet to the other (POST REQUEST)
    Note: The user's wallet id is the unique identifier as against the normal wallet account no in the real scenario


    4) Importing data from the Excel File

        a.  http://127.0.0.1:8000/api/import - Endpoint to import the file (POST REQUEST)

        Data from request
        -file

    Summary: kindly follow this documentation so as to properly use the apis.



