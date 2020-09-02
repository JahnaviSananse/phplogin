<!DOCTYPE html>
<html>
<head>
<title> Form </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<style>
.container
{
position: absolute;
top: 62%;
left: 45%;
transform: translate(-38%,-62%);
width: 550px;
background: #ffff;
padding: 45px;
box-sizing: border-box;
border: 1px solid rgba(0,0,0,.1);
box-shadow: 0 5px 10px rgba(0,0,0,.1);
}

    .error
    {
      color: red;
    }
    </style>
</head>

<body>
<div class="container">
<h2>Fill The below Form</h2>

<form class="cmxform" action="action.php" novalidate name="forms" id="forms" method="POST" enctype="multipart/form-data">

<div class="form-group">
<label for="uname">Name:</label>
<input type="text" class="form-control" id="uname" placeholder="Enter Your name" name="uname" minlength="2" required>
</div>

<div class="form-group">
<label for="email">Email Address:</label>
<input type="email" class="form-control" id="error_email" placeholder="Enter Your Email" name="email" size="32" required>
<span id="availibility"></span>
</div>

<div class="form-group">
<label for="pwd">Password:</label>
<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" minlength="5" required>
</div>

<div class="form-group">
<label for="number">Phone Number:</label>
<input type="tel" class="form-control" id="number" placeholder="Enter Your Phone Number" maxlength="10" name="number" minlength="10" required>
</div>

<div class="form-group">
<label for="picture">Profile Picture:</label>
<input type="file" class="form-control" id="picture" placeholder=" Upload Your Profile Picture" name="picture" required>
</div>

<button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
<button type="reset" class="btn btn-primary" id="reset" name="reset">Reset</button>
<br><br>

</form>
</div>

<script type="text/javascript">
$(function()
{
  $("form[name='forms']").validate({
  rules:
  {
  uname: 
  {
    required: true,
    minlength: 3
  },
  pwd:
  {
    required: true,
    minlength:8
  },
  number:
  {
  required: true,
  number:true
  }
},
  messages:
  {
    uname: 
    {
      required: "Please enter your Name",
      minlength : "must contain 3 characters"
    },
    pswd:
    {
      required: "Please provide a password",
      minlength:"Password must be in 8 characters"
    },
    number: 
    {
      required:"Enter vadid phone number",
      number:"Enter valid Phone Number"
    }
  },
submitHandler: function(form)
{
  form.submit();
}
});
});
</script>

<script>
  $(document).ready(function()
  {
    $('#error_email').blur(function()
    {
      var Email = $(this).val();
      $.ajax({
        url:"check.php",
        method:"POST",
        data:{email:Email},
        datatype:"email",
        success:function(html)
        {
          $('#availibility').html(html);
        }
      });
    });
  });
</script>