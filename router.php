<?php
  header('Content-type: text/html; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  session_start();
  $uri = explode('/',$_SERVER['REQUEST_URI']);
  require_once("php/db.php");
  require_once("php/classes/User.php");
  require_once("php/classes/Blog.php");
  require_once('php/classes/Bet.php');
  require_once("php/classes/simple_html_dom.php");
  
  
   $request = [
    'regUser'=>function(){return User::regUser();},
    'authUser'=>function(){return User::authUser();},
    'updateUser'=>function(){return User::updateUser();},
    'contactUs'=>function(){return User::contactUs();},
    'getUserById'=>function(){return User::getUserById($_SESSION['id']);},
    'uploadUserAvatar'=>function(){return User::uploadUserAvatar($_FILES['avatar']);},
    'addPost'=>function(){return Blog::addPost($_POST['title'],$_POST['content'],$_POST['author']);},
    'deletePost'=>function(){return Blog::deletePost();},
    'getPosts'=>function(){return Blog::getPosts();},
    'getPostById'=>function(){return Blog::getPostById($_POST['id']);},
    'updatePost'=>function(){return Blog::updatePost($_POST['id'],$_POST['title'],$_POST['content'],$_POST['author']);},
    'updateBet'=>function(){return Bet::updateBet();}, 
    'selectBet'=>function(){return Bet::selectBet();},
    'exit'=>function(){session_destroy(); header('Location:/auth');},
    'exitReact'=>function(){session_destroy();}
  ];
  foreach($request as $key=>$handler){
    if($uri[1]==$key){
      exit($handler());
    }
  }
  
  if($uri[1]=="index.php"){
    echo "hello world";
    $title = "Главная";
    $h1 = "Daily planner";
    $content = file_get_contents('view/index.html');
    var_dump ($uri);
    require_once('view/template.php');
  }else if($uri[1]=="blog.php"){
    $title = "Главная";
    $h1 = "Daily Blog";
    $content = file_get_contents('view/index.html');
    require_once('view/templateBlog.php');
  }else if($uri[1]=='about'){
    $title = "О нас";
    $h1 = "О нас";
    $content = file_get_contents('view/about.html');
    require_once('view/template.php');
  }else if($uri[1]=='project'){
    $title = "Описание проекта";
    $h1 = "Описание проекта";
    $content = file_get_contents('view/project.html');
    require_once('view/template.php');  
  } else if($uri[1]==""){
    $title = "Главная";
    $h1 = "Daily planner";
    $content = file_get_contents('view/index.html');
    //var_dump ($uri);
    require_once('view/template.php');
    }else if($uri[1]=='reg'){
    $title = "Регистрация на сайте";
    $h1 = "Регистрация на сайте";
    $content = file_get_contents('view/reg.html');
    require_once('view/template.php');
  }else if($uri[1]=='auth'){
    $title = "Вход на сайт";
    $h1 = "Вход на сайт";
    $content = file_get_contents('view/auth.html');
    require_once('view/template.php');
  }else if($uri[1]=='lk'){
    $content = file_get_contents('view/lk.php');
    require_once('view/template.php');
  }else if($uri[1]=='post'){
    $content = file_get_contents('view/post.html');
    require_once('view/template.php');  
  }else if($uri[1]=='fileUpload'){
    Blog::fileUpload();
      
  // Админка для нашего сайта
  }else if($uri[1]=='admin'){
    if($uri[2]=='postList'){
      $content = file_get_contents('view/postList.html');
    }else if($uri[2]=='addPost'){
      $content = file_get_contents('view/addPost.html');
    }else if($uri[2]=='editPost'){
      // Редактирование поста
      $content = file_get_contents('view/editPost.php');
    }
    require_once('view/templateAdmin.php');
  }
  
  //Bet для нашего сайта Пари
 
    else if($uri[1]=='betForm' and $_SESSION['id']){
    $title="Ввод статистики";
    $h1="Добавить статистику игры";
    $content=file_get_contents('view/betForm.html');
    require_once('view/template.php');
  } else if($uri[1]=='betSelectForm' and $_SESSION['id']){
    $title="Аналитика игр";
    $h1="Аналитика игр по параметрам";
    $content=file_get_contents('view/betSelectForm.php');
   	require_once('view/template.php');
	} else if(($uri[1]=='betForm' and empty($_SESSION['id'])) || ($uri[1]=='betSelectForm' and empty($_SESSION['id']))){
	  $content=file_get_contents('view/message.php');
	  require_once('view/template.php');
	}  
    
?>


