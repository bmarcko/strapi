<?php
include "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {

    /*$token = 'f5f69a64ae7f552e26d049af4d6b1bdff7dfb0fd3c7bc4d8829c07ea044ec79589f18f693ec1e4c205d4b7ee60a98d250fa7520ae5771463ea73805a8b190e856d8c5faf093fb04b4aa16f81c0f59c0f451512f438e4a6f010dfc9dba2c7b53d7b068ba4888f546ea7331e9758f545bfd172714dab8596d227006c5b32791a90';
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
    */

    $client = new Client([
        'base_url' => 'http://localhost:1337/api/'
    ]);

    $response = $client->request('GET','book?page=1&pageSize=66', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer' . '512af12323b0f823063cea78fa09265f123b0bd8953f0975e5a030eea96fb5192c7cb59bd8f20211bbfbeb3702513b575a7fa9f37685a65a648addedd4bb98e616ac80223e79c8df34c03dd092b20805e366e87fcc89fb63a864652f3dca354728df92d9d61f3c5e939452dc70caac59bfd632443b3d1508c4e5835fb5ed79de',
        ]
    ]);

    $book = $response->getBody();
    $books = json_decode($book);
    return $books
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
        <strong>
        <th>Name</th>
        <th>Author</th>
        <th>Category</th>
        </strong>
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