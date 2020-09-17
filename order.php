<?php
// Ascending Order
if(isset($_POST['ASC']))
{
    $asc_query = "SELECT * FROM tblusers where FullName ASC";
    $result = executeQuery($asc_query);
}

// Descending Order
elseif (isset ($_POST['DESC'])) 
    {
          $desc_query = "SELECT * FROM tblusers ORDER BY FullName DESC";
          $result = executeQuery($desc_query);
    }
    
    // Default Order
 else {
        $default_query = "SELECT * FROM tblusers";
        $result = executeQuery($default_query);
}


function executeQuery($query)
{
    $connect = mysqli_connect("localhost", "root", "", "demo_pro");
    $result = mysqli_query($connect, $query);
    return $result;
}

?>
