<?php
ob_start();
$uzytkownicy = array(1 =>
    array('login' => 'user1', 'haslo' => sha1('ppp')),
    array('login' => 'user2', 'haslo' => sha1('ddd')),
    array('login' => 'user3', 'haslo' => sha1('fff'))
);

function czyIstnieje($login, $haslo)
{
    global $uzytkownicy;

    $haslo = sha1($haslo);

    foreach($uzytkownicy as $id => $dane)
    {
        if($dane['login'] == $login && $dane['haslo'] == $haslo)
        {
            // O, jest ktos taki - zwroc jego ID
            return $id;
        }
    }
    // Jeżeli doszedłeś a tutaj, to takiego użytkownika nie ma
    return false;
} // end czyIstnieje();
session_start();

if (!isset($_SESSION['inicjuj']))
{
    session_regenerate_id();
    $_SESSION['inicjuj'] = true;
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
}


if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])
{
    die('Proba przejecia sesji udaremniona!');
}

if(!isset($_SESSION['user']))
{
    // Sesja się zaczyna, wiec inicjujemy użytkownika anonimowego
    $_SESSION['user'] = 0;
}
?>
<!DOCTYPE html>
<html>
<head><!-- CDN hosted by Cachefly -->
    <meta>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    </meta>
    <script>tinymce.init({selector:'textarea', width : 798});</script>
    <link href="css/login.css" rel="stylesheet">
</head>
    <body>
        <div class="message">


            <?php
            if($_SESSION['user'] > 0)
            {
                // Ktos jest zalogowany
                echo 'Witaj, '.$uzytkownicy[$_SESSION['user']]['login'].' na naszej stronie!';
            }
            else
            {
                // Niezalogowany
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    if(($id = czyIstnieje($_POST['login'], $_POST['haslo'])) !== false)
                    {
                        // Logujemy uzytkownika, wpisal poprawne dane
                        $_SESSION['user'] = $id;

                        echo 'Dziekujemy, zostales zalogowany! Jeśli przkierowanie nie nastąpi w ciągu 3 sekund kliknij: <a href="admin.php">Dalej</a>';
                        header('Location: admin.php');



                    }
                    else
                    {
                        echo 'Podales nieprawidlowe dane, zegnaj! <a href="login.php">Dalej</a>';
                    }
                }
                else
                {

                    echo '<form method="post" action="login.php">
                            Login: <input type="text" name="login"/><br>
                            Hasło: <input type="password" name="haslo"/><br>
                            <input type="submit" value="Zaloguj"/></form>';
                }
            }
            ?>

        </div>
    </body>
</html>
<?php ob_end_flush();?>