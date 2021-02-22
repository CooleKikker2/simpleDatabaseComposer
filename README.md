# Simple database

## Introduction

> Simple Database is a very simple PHP API for using an SQL-Database with only a few lines of code. Use a full working SQL database with only a few lines of code.

## Code Samples

> Full Documentation can be found here: http://example.com/

> <b>Connect to database</b><br><br>
> You can simply connect to your database using the following 2 lines of code.
```php
$database = new Database("Your Servername", "Your Database User", "YourUserPassword", "YourDatabaseName");
$database->connect();
```
> After connection the database is available in the variable $database.<br><br>
> <b>Insert into database</b><br><br>
> You can also easily insert data into a database using 2 arrays. One array is for the row names, the other for the rows value
```php
$row = ['name', 'description', 'price'];
$value = ['Soap', 'A nice soap', 5.95];
$if($database->insertRow('products', $row, $value)){
    echo "Succesfully added product to products. The insert id is: " . $database->getInsertId();
}
```
> After inserting columns into the database as above, the last inserted id is available in $database->getInsertId();<br><br>
> <b>Read from database</b><br><br>
> To read data from the database you need to use the $database->readAll(table) function.
```php
$data = $database->readAll("products");
while($row = $data->fetch_assoc()){
    echo $row['name'];
}
```
> In the example above we get all data from the database and fetch the data to the variable $row. After that we can return the row['name'] from the database.

## Installation

> To install this API you can simply download the files on this github and put it into your root directory. Enable the API by adding the following line of code at the top of your PHP file
```php
require_once("config/database/database.php");
```