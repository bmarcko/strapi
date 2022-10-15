<?php
//include "vendor/autoload.php";

//use GuzzleHttp\Client;
//use GuzzleHttp\Psr7\Request;

function getBooks() {
    $token = 'f5f69a64ae7f552e26d049af4d6b1bdff7dfb0fd3c7bc4d8829c07ea044ec79589f18f693ec1e4c205d4b7ee60a98d250fa7520ae5771463ea73805a8b190e856d8c5faf093fb04b4aa16f81c0f59c0f451512f438e4a6f010dfc9dba2c7b53d7b068ba4888f546ea7331e9758f545bfd172714dab8596d227006c5b32791a90';
    $curl = curl_init(); //Initializes curl
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:1337/api/books');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ]); // Sets header information for authenticated requests

    $res = curl_exec($curl);
    curl_close($curl);
    return json_decode($res);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Books</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Author</th>
        <th>Category</th>
    </tr>
<tbody>
    <?php
    $books = getBooks();
    foreach ($books->data as $bookData) {
        //echo $bookData->id;
        $book = $bookData->attributes;
        //print_r($book);
    ?>
    <tr>
        <td><?php echo $book->name; ?></td>
        <td><?php echo $book->author; ?></td>
        <td><?php echo $book->category; ?></td>
    </tr>   
    <?php } ?>
</tbody>
</table>
</body>
</html>