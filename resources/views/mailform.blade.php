<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Send Mail Using Mail Function in Laravel 5.7 or Laravel 5.8 - Experts PHP</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<body>
<div class="about-banner">
</div>
<div class="contact-background"> 
<div class="contactussec">
<div class="container">
<div class="col-md-4">
<div class="contactformsec clearfix">
<form action="{{url('send')}}" method="post">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<label>Your Email Address</label>
<input type="email" class="form-control" name="email">
<input type="submit" name="submit" value="Submit" class="submit-btn">
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>