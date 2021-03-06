<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/house/index.php'));
}

$id = $_GET['id'];



if(is_post_request()){

  $result = delete_subject($id);
  redirect_to(url_for('/house/index.php'));

} else{
  $subject = find_subject_by_id($id);
}

?>

<?php $page_title = 'Delete Subject'; ?>

<?php include_once(PRIVATE_PATH .'/header.php')?>

<div class="contents">
  <table> 
    <tr>
      <td class="td-title"><h1><?php echo h($subject['title']);?></h1></td>
    </tr>  
    <tr class="tr-writer-date">
      <td class="td-writer"><?php echo 'Writer : '. h($subject['writer']);?></td>
      <td class="td-date"><?php echo 'date : '. h($subject['date']);?></td>
    </tr>
  </table>
  <table>
    <tr>
      <td class="td-contents">
        <?php echo h($subject['contents']);?>
      </td>
    </tr>
  </table>
  <div class="delete-box">
  <p> You want to delete this page?</p>
    <div class="bottom-btn">
      <form action="<?php echo url_for('/house/delete.php?id='. $id);?>" method="post">
        <input type="submit" value="Yes" class="btn btn-primary"/>
      </form>
      <a href="<?php echo url_for('/house/index.php');?>" class="btn btn-primary ">No</a>
    </div>
  </div>
</div>

<?php include_once(PRIVATE_PATH .'/footer.php')?>