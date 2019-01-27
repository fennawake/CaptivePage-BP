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

  $permissions = ['email', 'user_gender', 'user_birthday'];
  
  try {
    if(isset($_SESSION['facebook_access_token'])){
      $accessToken = $_SESSION['facebook_access_token'];
    }else{
      $accessToken = $helper->getAccessToken();  
    }
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if (! isset($accessToken)) {
    $url_login = 'http://localhost/BurleighPavilion/CaptivePage/facebook_login.php';
    $loginUrl = $helper->getLoginUrl($url_login, $permissions);
  }else{
    $url_login = 'http://localhost/BurleighPavilion/CaptivePage/facebook_login.php';
    $loginUrl = $helper->getLoginUrl($url_login, $permissions);

    if(isset($_SESSION['facebook_access_token'])){
      $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
      $_SESSION['facebook_access_token'] = (string) $accessToken;
      $oAuth2Client = $fb->getOAuth2Client();
      $_SESSION['facebook_access_token'] = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
      $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }

    try {
      $response = $fb->get('/me?fields=name, picture, email, user_gender, user_birthday');
      $user = $response->getGraphUser();
      $id_user = $user['id'];
      $name_user = $user['name'];
      $email_user = $user['email'];
      $picture_user = $user['picture']['url'];
      
      $sql = "SELECT * FROM customers WHERE email='$email_user' ";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      if($row != 0){
        header("Location: https://www.instagram.com/burleighpavilion/");
      }else{
        $query = "INSERT INTO customers (id_facebook, user,email, picture_url, gender, birth_date) VALUES ('$id_user', '$name_user','$email_user', '$picture_user', '$gender_user', '$birth_user')";
        $insert = mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) != 0){
          header('Location: https://www.instagram.com/burleighpavilion/'); 
        }else{
          header('Location: index.html?msg="facebookLoginFailed"');
        }
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