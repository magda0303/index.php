<?php
    date_default_timezone_set('Europe/Warsaw');
    include 'dbh.inc.php';
    include 'comments.inc.php';
    define('SITE_KEY', '6LcCpuAZAAAAACOQiW5MRlmqGcHA4lme_alQphAs');
    define('SECRET_KEY', '6LcCpuAZAAAAAHcGc8J_JPKSqdGhbGDhPLdOMvyB');
    
if($_POST){
    function getCaptcha($SecretKey){
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    //var_dump($Return);
    if($Return->success == true && $Return->score > 0.5){
        "Succes!";
    }else{
        "You are a Robot!!";
    }
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>komentarze</title>
    <link rel ="stylesheet" href="media/css/style.css">
    <script src='https://www.google.com/recaptcha/api.js?render=6LcCpuAZAAAAACOQiW5MRlmqGcHA4lme_alQphAs'></script>
</head>
<body>
<div class="comments">
    <h2>Komentarze:</h2>
<?php
  echo "<form method= 'POST' action='".setComments($conn)."'>
    <input type='hidden' name='userid' value='Anonymous'>
    <input type='hidden' name='date' value='".date('Y-m-d  H:i:s')."'>
    NICK    :<input type='text' name='nick' required ><br></br>
    E-MAIL :<input type='text' name='email' required><br></br>
    TREŚĆ   :<textarea name ='message'required></textarea><br>
    <button type='submit' name='commentSubmit'>Dodaj komentarz </button>
    <input type='hidden' id='g-recaptcha-response' name='g-recaptcha-response' /><br >

    
    </form>";
getComments($conn);
?>
</div>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'home'})
            .then(function(token) {
                document.getElementById('g-recaptcha-response').value=token;
            });
    });
</script>
</body>
</html>