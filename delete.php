<?php
    include 'conn.php';
    if (isset($_POST['delete'])) 
    {
        $name = $_POST['item'];
        $seperate_all_Name = implode(",",$name);
        //echo "$seperate_all_Name";
        $queries = "DELETE FROM tblusers WHERE FullName = '$seperate_all_Name'";
        $query = mysqli_query($con,$queries);
        if($query)
        { 
            //echo "DELETED Name's Are $seperate_all_Name";
            header('location:pagination.php');
        }
        else
        {
            echo " Somthing went Wrong... ";
            //header('location:pagination.php');
        }
    }
?>
