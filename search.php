<?php
// Assuming you have a database connection established

include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email and password match in the database
    $query = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    // Check if any rows are returned
    if (mysqli_num_rows($result) == 1) {
        // User found, fetch user data
        $user = mysqli_fetch_assoc($result);

        // Fetch pass transactions for the user
        $userId = $user['user_id'];
        $passTransactionQuery = "SELECT * FROM Pass_Transactions WHERE user_id = $userId";
        $passTransactionResult = mysqli_query($connection, $passTransactionQuery);

        // Prepare user information array
        $userInfo = array(
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'balance' => $user['balance'],
            'transactions' => array()
        );

        // Fetch pass transactions for the user
        while ($transaction = mysqli_fetch_assoc($passTransactionResult)) {
            $userInfo['transactions'][] = array(
                'transaction_id' => $transaction['transaction_id'],
                'transaction_date' => $transaction['transaction_date'],
                'transaction_amount' => $transaction['transaction_amount']
            );
        }

        // Return user information as JSON
        header('Content-Type: application/json');
        echo json_encode($userInfo);
    } else {
        // User not found
        $error = array('error' => 'User not found!');
        header('Content-Type: application/json');
        echo json_encode($error);
    }
}
?>
