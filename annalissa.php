<?php
session_start(); // Start the session if not already started

// Capture visitor data
$ipAddress = $_SERVER['REMOTE_ADDR']; // Get IP address
$dateTime = date('Y-m-d H:i:s'); // Get current date and time
$referer = $_SERVER['HTTP_REFERER'] ?? 'Direct'; // Get referring URL
$userAgent = $_SERVER['HTTP_USER_AGENT']; // Get user agent
$requestUri = $_SERVER['REQUEST_URI']; // Get the URI which was given in order to access this page
$queryString = $_SERVER['QUERY_STRING'] ?? 'No query'; // Get the query string if any
$cookies = json_encode($_COOKIE); // Convert all cookies into a JSON string
$sessionData = json_encode($_SESSION); // Convert all session data into a JSON string
$method = $_SERVER['REQUEST_METHOD']; // Get request method
$protocol = $_SERVER['SERVER_PROTOCOL']; // Get protocol type (HTTP/1.1, HTTP/2, etc.)
$serverName = $_SERVER['SERVER_NAME']; // Get server name
$port = $_SERVER['SERVER_PORT']; // Get server port
$contentLength = $_SERVER['CONTENT_LENGTH'] ?? 'Unknown'; // Get content length of the request
$contentType = $_SERVER['CONTENT_TYPE'] ?? 'Unknown'; // Get content type of the request
$httpConnection = $_SERVER['HTTP_CONNECTION'] ?? 'Unknown'; // Get connection type
$https = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'Yes' : 'No'; // Check if HTTPS is used
$authUser = $_SERVER['PHP_AUTH_USER'] ?? 'Anonymous'; // Get authenticated user
$authPassword = $_SERVER['PHP_AUTH_PW'] ?? 'None'; // Get password for HTTP authentication

// Create a string to record
$log = "Date & Time: $dateTime - IP: $ipAddress - Referrer: $referer - User Agent: $userAgent - Requested URI: $requestUri - Query: $queryString - Cookies: $cookies - Session: $sessionData - Method: $method - Protocol: $protocol - Server: $serverName - Port: $port - Content Length: $contentLength - Content Type: $contentType - Connection: $httpConnection - HTTPS: $https - Auth User: $authUser - Auth Password: $authPassword\n";

// File to write to
$file = 'visitor_log.txt';

// Write the data to the log file
file_put_contents($file, $log, FILE_APPEND);

// Optional: Display a message or redirect the user
echo "Thank you for visiting!";
?>
