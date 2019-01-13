<?php
  session_start();
  unset($_SESSION['facebook_access_token']);
  require_once __DIR__ . '/js/Facebook/autoload.php';
  include 'conexao.php';

  $fb = new \Facebook\Facebook([
    'app_id' => '503820390025659',
    'app_secret' => 'db734b44ddaf0d716fc1ee124abb07d7',
    'default_graph_version' => 'v2.10',
  ]);

  $helper = $fb->getRedirectLoginHelper();
  //var_dump($helper);

  $permissions = ['email']; // Optional permissions

  try {
    if(isset($_SESSION['facebook_access_token'])){
      $accessToken = $_SESSION['facebook_access_token'];
    }else{
      $accessToken = $helper->getAccessToken();  
    }
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if (! isset($accessToken)) {
    $url_login = 'http://localhost/BurleighPavilion/CaptivePage/facebook_login.php';
    $loginUrl = $helper->getLoginUrl($url_login, $permissions);
  }else{
    $url_login = 'http://localhost/BurleighPavilion/CaptivePage/facebook_login.php';
    $loginUrl = $helper->getLoginUrl($url_login, $permissions);

    //user autenticated
    if(isset($_SESSION['facebook_access_token'])){
      $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
      $_SESSION['facebook_access_token'] = (string) $accessToken;
      $oAuth2Client = $fb->getOAuth2Client();
      $_SESSION['facebook_access_token'] = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
      $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }

    try {
      // Returns a `Facebook\FacebookResponse` object
      $response = $fb->get('/me?fields=name, picture, email');
      $user = $response->getGraphUser();
      $id_user = $user['id'];
      $name_user = $user['name'];
      $email_user = $user['email'];
      $picture_user = $user['picture']['url'];
      // echo "id: " . $id_user . "<br>";
      // echo "name: " . $name_user . "<br>";
      echo "email: " . $email_user . "<br>";
      // echo "picture: <img src=" . $picture_user . " /><br>";
      //echo "user: " . $user . "<br>";
      //$result_usuario = "SELECT * FROM customers WHERE email=" . $email_user;
      //$resultado_usuario = mysqli_($conn, $result_usuario);
      //var_dump($resultado_usuario);

      // executa a consulta
      $sql = "SELECT * FROM customers WHERE email='fenna.wake@gmail.com' ";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      echo 'AQUI';
      if($row != 0){
        $row_user = mysqli_fetch_assoc($result);
          $id = $row_user['id_customer'];
          $id_facebook= $row_user['id_facebook'];
          $user = $row_user['user'];
          $email= $row_user['email'];
          //header("Location: /alert-do-bootstrap/administrativo.php");
          echo $email;
          echo 'ENTROU';
      }else{
        echo 'erro';
        $_SESSION['msg'] = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
				//header("Location: index.html");
      }
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
  }
  
?>

<a href="sair.php">sair</a> - <a href="<?php echo $loginUrl; ?>">Facebook</a>