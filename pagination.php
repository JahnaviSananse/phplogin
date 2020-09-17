<!DOCTYPE html>
<html>
<head>
<title>Form</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<style>
.main-div
{
    position: absolute;
    top: 15%;
    left: 65%;
    transform: translate(-90%,-10%);
    width: 600px;
    background: #ffff;
    padding: 45px;
    box-sizing: border-box;
    border: 1px solid rgba(0,0,0,.1);
    box-shadow: 0 5px 10px rgba(0,0,0,.1);
}
table, th, td 
{
    border: 2px solid black;
    border-collapse: collapse;
    background-color: #ddddff;
    box-shadow: 0 10px 20px 0 rgba(0,0,0,.03);
    border-radius: 10px;
    margin: auto;
}
/* .search-div
{
    position: absolute;
    top: 10%;
    left: 5%;
    background: #ffff;
    padding: 45px;
    box-sizing: border-box;
    border: 1px solid rgba(0,0,0,.1);
    box-shadow: 0 5px 10px rgba(0,0,0,.1);
} */
</style>
</head>
<body>

<!-- <form class="search-div" action="search.php" method="POST">
<input type="text" name="search">
<input type="submit" name="submit" value="Search">
</form> -->
<?php
    session_start();
    if (isset($_SESSION['status']) && $_SESSION['status'] !='') 
    {
        ?>
        <h5><?php echo $_SESSION['status'];?></h5>
        <?php
        unset($_SESSION['status']);
    }
?>
<div class="main-div">
<h2 align="center">
List of Candidates for Register
</h2>
<br><br>

<div class="center-div">
<div class="table-responsive">
<table width="50%" border="1" cellpadding="5" cellspacing="5" id="table">
    <thead>
        <tr>
            <th><input type="checkbox" name="chkall" id="chkall" onclick="toggle(this);" >Select All</th>
            <th>Name</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th>Profile Picture</th>
        </tr>
    </thead>
<tbody>

<form action="delete.php" method="POST" onSubmit="return delete_confirm();">

<?php
include 'conn.php';
if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
    $page = 1;
}
$num_per_page = 10;
$start_from = ($page-1)*10;
$selectQuery = "select * from tblusers limit $start_from,$num_per_page";
$query = mysqli_query($con,$selectQuery);
$nums = mysqli_num_rows($query);
while ($res = mysqli_fetch_array($query)) 
{
    ?>
<tr>
    <td><input type="checkbox" class="chkitem" id="chkitem" name="item[]" 
    value="<?php echo $res['FullName']; ?>" ></td>
    <td><?php echo $res['FullName']; ?> </td>
    <td><span class="email-style"><?php echo $res['EmailId']; ?></span></td>
    <td><?php echo $res['ContactNo']; ?></td>
    <td>
        <img src="<?php echo $res['ProfilePicture'];?>" width="60" height="40"></td>
    </tr>
    <?php } ?>
</tbody>
<tr>
    <!-- <td colspan=5> <a href="delete.php" class="btn btn-danger">DELETE CHECKED DATA</a></td> -->
    <td colspan=5><input type="submit" value="DELETE CHECKED DATA" name="delete" class="btn btn-danger" > 
    <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></td>
</tr>
</form>
</table><br><br><br><br><br><br><br>

<?php
$selectQuery = "select * from tblusers";
$query = mysqli_query($con,$selectQuery);
$nums = mysqli_num_rows($query);
$total_page = ceil($nums/$num_per_page);
if($page>1)
{
    echo "<a href='pagination.php?page=".($page-1)." ' class='btn btn-danger'>previous</a>";
}
for($i=1;$i<$total_page;$i++)
{
    echo "<a href='pagination.php?page=".$i."' class='btn btn-dark'>$i</a>";
}
if($i>$page)
{
    echo "<a href='pagination.php?page=".($page+1)." ' class='btn btn-danger'> Next </a>";
}
?>
</div>
</div>
</form>
</div>
</body>
</html>
<script>
$(document).ready(function() {
    $("#chkall").change(function() {
        if (this.checked) {
            $(".chkitem").each(function() {
                this.checked=true;
            });
        } else {
            $(".chkitem").each(function() {
                this.checked=false;
            });
        }
    });
    $(".chkitem").click(function () 
    {
        if ($(this).is(":checked")) 
        {
            var isAllChecked = 0;
            $(".chkitem").each(function() 
            {
                if (!this.checked)
                    isAllChecked = 1;
            });
            if (isAllChecked == 0) 
            {
                $("#chkall").prop("checked", true);
            }     
        }
            else 
            {
                $("#chkall").prop("checked", false);
            }
    });
});
</script>

<script type="text/javascript">
function delete_confirm(){
if($('.chkitem:checked').length > 0)
{
    var result = confirm("Are you sure to delete selected users ?");
    if(result)
    {
        return true;
    }
    else
    {
        return false;
    }
}
else
{
    alert('Select at least 1 record to delete.');
    return false;
}
}
</script>

<script>
$(document).ready(function()
{
    $('#table').dataTable({
        //paging: false,
        //searching: false,
        "aaSorting": [],
        columnDefs: [{
        orderable: false,
        targets: 0
},
{
    orderable: false,
    targets: 3
},
{
    orderable: false,
    targets: 4
}]
 });
});
</script>