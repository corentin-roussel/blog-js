<?php if(isset($_GET['post_comm'])): ?>

<form action="" method="POST" id="formComm">
    <label class="form-label" for="comment">Comment : </label>
    <textarea class="space" name="comment" id="comment" cols="30" rows="5"></textarea>
    <div id="errorComm" class="error"></div>

    <input class="button-form" type="submit" name="submitComm" id="submitComm" value="Comment">
</form>
<?php  die(); endif;?>

<?php if(isset($_GET['rep_comm'])): ?>
<form action="" method="POST" id="formSubmitRep">
    <label for="rep-comment">Comment : </label>
    <input type="text" name="rep-comment" id="rep-comment">
    <div id="errorRep" class="error"></div>

    <input type="submit" name="submitRep" id="submitRep" value="Comment">
</form>
<?php die(); endif;


?>
