    // prepare the query
    $con = db_connect();

    $query = 'SELECT * FROM users';

    $query = pg_prepare ($con, 'user_find', $query);

    // execute the query
    $result = pg_execute ($con, 'user_find', [$email]);

    // fetch the results
    $users = pg_fetch_all ($result);

    die(var_dump($users));