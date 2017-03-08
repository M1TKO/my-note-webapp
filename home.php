<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: index.php');
}else {
	$user_id = $_SESSION['user_id'];
	require 'files/Validate.php';
	require 'files/Note.php';
	$n = new Note();
	include 'files/DB.php';
	$db = new DB('localhost', 'root', '', 'my_note');
	$notes = $db->getNotes($user_id);
	$errorNewNote = '';
	$succMessage = "Done.";
	$title = "MyNote - Home";
	$stylesheet = '<link rel="stylesheet" type="text/css" href="css/home.css">';
	include 'files/headTemplate.php';
}
?>
<body>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['addNoteSubmit'])){
			try{
				echo '<pre>'.print_r($_POST, true).'</pre>';

				if(isset($_POST['note_title']) && strlen($_POST['note_title']) > 1){
					$note_title = Validate::noteText($_POST['note_title']);
					
					if(isset($_POST['note_body']) && strlen($_POST['note_body']) > 1){
						$note_body = Validate::noteText($_POST['note_body']);

						if( !($db->addNote($user_id, $note_title, $note_body)) ){
							throw new Exception("Adding note failed. ");	
						}else{;
							echo '<style>div[class="alert alert-success"]{display:block;}</style>';
						}

					} else{
						throw new Exception("Note body is too short. ");
					}
					
				} else{
					throw new Exception("Note title is too short. ");
				}
			}catch(Exception $e){
				$errorNewNote = $errorNewNote . $e->getMessage();
				echo '<style>div[class="alert alert-danger"]{display:block;}</style>';
			}
		}

		if(isset($_POST['logOut'])){
		}
	}
 ?>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-5">
      <h1 id='userTitle'>MyNote</h1>
      <h4><?php echo $_SESSION['user']; ?></h4>
      <ul class="nav nav-pills nav-stacked col-sm-3">
        <li><a href="#section1">Change username</a></li>
        <li><a href="#section2">Change password</a></li>
        <li><a href="#section3">Change email</a></li>
        <li ><button id="logout_btn">Log Out</button></li>
      </ul><br>
		
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      	<div class="form-group">
      		<input type="text" name="note_title" placeholder="Note Title ..." class="form-control">
      	</div>
      	<div class="form-group">
      		<textarea class="form-control" name="note_body" placeholder="Note body ..." rows="10" id="comment"></textarea>
		</div>
      	<div class="alert alert-danger">
  				<strong>* </strong><?php echo $errorNewNote; ?>
		</div>
      	<div class="alert alert-success">
  				<strong>* </strong><?php echo $succMessage; ?>
		</div>
      	<input type="submit" name="addNoteSubmit" value="Create note" class="btn btn-default">
    </form>

    </div>
    <br>
    
    <div class="col-sm-5" id="note">
    <?php $n->displayNotes($notes); ?>
    </div>
  </div>
</div>

<script>
	var is_clicked_logout = document.getElementById(`logout_btn`);

	is_clicked_logout.onclick = function(){
		window.location.assign('files/destroy.php');
	}

</script>
</body>
</html>