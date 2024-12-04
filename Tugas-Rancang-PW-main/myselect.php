<? 
include 'database.php';

$query = "SELECT * FROM akun";
$result = $conn->query($query);

if($result) 
{
    while($row = $result->fetch_assoc())
    {
        print_r($row);
    }
} else {
    echo 'error: '.$conn->error;

}

$conn->close();

?>