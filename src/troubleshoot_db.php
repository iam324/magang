<?php
// troubleshoot_db.php
// A script to diagnose database connection issues in detail.

// --- Connection Details ---
// These should match your db.php, but are listed here for explicit testing.
$servername = "127.0.0.1";
$username = "root";
$password = ""; // Default XAMPP password is empty
$dbname = "db_news";
$port = 3306; // Default MySQL/MariaDB port

echo "<h1>Database Connection Troubleshooter</h1>";
echo "<p>Attempting to connect to MariaDB/MySQL...</p>";
echo "<ul>";
echo "<li><strong>Server/Host:</strong> " . $servername . "</li>";
echo "<li><strong>Port:</strong> " . $port . "</li>";
echo "<li><strong>Username:</strong> " . $username . "</li>";
echo "<li><strong>Database:</strong> " . $dbname . "</li>";
echo "</ul>";

// --- Step 1: Check if mysqli extension is loaded ---
if (!function_exists('mysqli_connect')) {
    echo "<h2><font color='red'>Fatal Error:</font> The <code>mysqli</code> extension is not loaded in your PHP configuration.</h2>";
    echo "<p>Please edit your <code>php.ini</code> file and uncomment (remove the semicolon from) the line: <code>extension=mysqli</code></p>";
    exit;
} else {
    echo "<p><font color='green'>OK:</font> <code>mysqli</code> extension is available.</p>";
}

// --- Step 2: Attempt Connection ---
// Suppress the default warning with '@' to provide a custom, more helpful message.
$conn = @new mysqli($servername, $username, $password, $dbname, $port);

// --- Step 3: Analyze Connection Result ---
if ($conn->connect_error) {
    echo "<h2><font color='red'>Connection Failed!</font></h2>";
    echo "<p><strong>Error Code:</strong> " . $conn->connect_errno . "</p>";
    echo "<p><strong>Error Message:</strong> " . htmlspecialchars($conn->connect_error) . "</p>";
    
    echo "<h3>Possible Causes & Solutions:</h3>";
    echo "<ol>";
    if ($conn->connect_errno == 2002) {
        echo "<li><strong>Server Not Running:</strong> The database server might not be running. Ensure that the 'MySQL' service is started in your XAMPP Control Panel.</li>";
        echo "<li><strong>Incorrect Host/Port:</strong> The server address (<code>" . $servername . "</code>) or port (<code>" . $port . "</code>) might be wrong. Verify them in your XAMPP or database configuration.</li>";
        echo "<li><strong>Firewall:</strong> A firewall might be blocking the connection on port " . $port . ".</li>";
    } elseif ($conn->connect_errno == 1045) {
        echo "<li><strong>Incorrect Username/Password:</strong> The username (<code>" . $username . "</code>) or password might be incorrect. Double-check them. The default XAMPP password for 'root' is usually empty.</li>";
    } elseif ($conn->connect_errno == 1044) {
        echo "<li><strong>Incorrect Database Name:</strong> The database '<code>" . $dbname . "</code>' may not exist. Make sure you have created it using phpMyAdmin.</li>";
    } elseif (str_contains($conn->connect_error, 'is not allowed to connect')) {
        echo "<li><strong>Permission Denied:</strong> This is a common issue. The user `<strong>" . $username . "</strong>` is not allowed to connect from your application's location (`localhost` or `127.0.0.1`).</li>";
        echo "<ul>";
        echo "<li><strong>Solution 1 (Recommended):</strong> Create a new database user. Go to phpMyAdmin -> User accounts -> Add user account.</li>";
        echo "<li>Create a new user (e.g., 'app_user').</li>";
        echo "<li>Set Host name to `localhost`.</li>";
        echo "<li>Set a secure password.</li>";
        echo "<li>Grant all privileges on the database `db_news`.</li>";
        echo "<li>Then, update your `src/db.php` with the new username and password.</li>";
        echo "</ul>";
    } else {
        echo "<li>An unknown database error occurred. The details above are all that is available.</li>";
    }
    echo "</ol>";

} else {
    echo "<h2><font color='green'>Success!</font></h2>";
    echo "<p>Successfully connected to the database '<code>" . $dbname . "</code>'.</p>";
    echo "<p>Your application should now be working correctly. If you still see errors in your main app, the problem is not with the database connection itself.</p>";
    $conn->close();
}

echo "<hr>";
echo "<p><em>Troubleshooting script finished.</em></p>";

?>