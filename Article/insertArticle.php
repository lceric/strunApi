<?php
  // 登录
        // header('Access-Control-Allow-Origin:*');
//header('Access-Control-Allow-Origin', '*');
//header("Access-Control-Max-Age: 86400"); 
//header("Access-Control-Allow-Headers: Content-Type"); 
//header("Access-Control-Allow-Methods: OPTIONS, GET, PUT, POST, DELETE");
if($_SERVER['REQUEST_METHOD']=="OPTIONS") {
    $rest = new PubFun();
    $rest->resResult(true);
}
  require_once ("../Base/PubFun.php");
  require_once ("ArticleHandler.php");
  if(isset($_POST['userid'])
    &&isset($_POST['title'])
    &&isset($_POST['author'])
    &&isset($_POST['articleintro'])
    &&isset($_POST['content'])
    &&isset($_POST['classify'])
  ) {
    $userid = $_POST['userid'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $articleintro = $_POST['articleintro'];
    $content = $_POST['content'];
    $classify = $_POST['classify'];

    $articleRestHandler = new ArticleHandler();
    $articleRestHandler->insertArticle($userid, $title,$author, $articleintro,$content, $classify);
  } else {
    $message = array(
      'message' => '数据提交有误'
    );
    $rest = new PubFun();
    $rest->responseInsertResult(false, $message);
    // echo json_encode($message);
  };

?>