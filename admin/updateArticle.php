<?php

/**
 * @Author: 宏达
 * @Date:   2017-11-02 18:01:51
 * @Last Modified by:   宏达
 * @Last Modified time: 2017-11-02 19:27:35
 */
header('Content-type:text/html;charset=utf8');
if($_SERVER['REQUEST_METHOD']=='GET'){
    include '../libs/db.php';
    include '../libs/function.php';
    $nid=$_GET['nid'];
    $cate = new unit();
    $option=$cate->cateTree(0,$mysql,'category',0,$nid);
    $title=$cate->selectTwo($mysql,'article',$nid,'title');
    include '../template/admin/updateArticle.html';
}else{
    include '../libs/db.php';
    $nid=$_POST['nid'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $content=$_POST['content'];
    $thumb=$_POST['thumb'];
    $cid=$_POST['cid'];
    $sql="update article set title='{$title}',description='{$description}',content='{$content}',thumb='{$thumb}',cid='{$cid}' where nid={$nid}";
    $mysql->query($sql);
    if($mysql->affected_rows){
        $message='栏目修改成功';
        $url='showArticle.php';
        include '../template/admin/message.html';
    }else{
        $message='栏目修改失败';
        $url='showArticle.php';
        include '../template/admin/message.html';
    }
}