<?php 
if(isset($_POST["Import"]))
{
    //First we need to make a connection with the database
    $host='localhost'; // Host Name.
    $db_user= 'root'; //User Name
    $db_password= 'root';
    $db= 'engelsystem'; // Database Name.
    $conn=mysqli_connect($host,$db_user,$db_password,$db) or die (mysqli_error());
    // $con = mysqli_connect("localhost","my_user","my_password","my_db");

    // mysql_select_db($db) or die (mysql_error());
    echo $filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        // $file = fopen($filename, "r");
        //$sql_data = "SELECT * FROM prod_list_1 ";
        $file = fopen($filename, "r");
        $count = 0;
        // while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)

        {
            // print_r($emapData); die;
            //exit();
           $count++;
           if($count>1){                                  // add this line
                 $sql = "INSERT into prod_list_1(p_bench,p_name,p_price,p_reason) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]')";
             mysqli_query($conn,$sql);
    } 
            // $sql = "INSERT into prod_list_1(p_bench,p_name,p_price,p_reason) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]')";
            // mysql_query($sql);
        }
        fclose($file);
        echo 'CSV File has been successfully Imported';
        header('Location: index.php');
    }
    else
        echo 'Invalid File:Please Upload CSV File';
}
?>


<form enctype="multipart/form-data" method="post" role="form">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="file" id="file" size="150">
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>
    <button type="submit" class="btn btn-default" name="Import" value="Import">Upload</button>
</form>

