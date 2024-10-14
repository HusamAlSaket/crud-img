<?php
include('config.php');

if (isset($_POST['submit'])) {
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/' . $file_name;

    $query = mysqli_query($con, "INSERT INTO images (file) VALUES ('$file_name')");

    if (move_uploaded_file($tempname, $folder)) {
        echo "<h2>File uploaded successfully</h2>";
    } else {
        echo "<h2>File didn't upload successfully</h2>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image" /><br /> <br />
        <button type="submit" name="submit">Submit</button>
    </form>

    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Image</th>
            </tr>
            <?php
            $res = mysqli_query($con, "SELECT * FROM images");
            while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><img src="images/<?php echo htmlspecialchars($row['file']); ?>" alt="Image" width="100" height="100"></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
