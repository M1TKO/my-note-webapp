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
	$errorChange = '';
	$succMessage = "Done.";
	$title = "MyNote - Home";
	$stylesheet = '<link rel="stylesheet" type="text/css" href="css/home.css">';
	include 'files/headTemplate.php';
	include 'files/User.php';
}
?>
<body>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['addNoteSubmit'])){
			try{
				// echo '<pre>'.print_r($_POST, true).'</pre>';

				if(isset($_POST['note_title']) && strlen($_POST['note_title']) > 1){
					$note_title = Validate::noteText($_POST['note_title']);
					
					if(isset($_POST['note_body']) && strlen($_POST['note_body']) > 1){
						$note_body = Validate::noteText($_POST['note_body']);

						if( !($db->addNote($user_id, $note_title, $note_body)) ){
							throw new Exception("Adding note failed. ");	
						}else{;
							header('Refresh: 0; ./');
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


		if(isset($_POST['change_username'])){
			try{
			$new_name = Validate::username($_POST['new_username']);
			if(strlen($new_name) > 2){
				if(!($db->userDataExists('username', $new_name))) {

		            if($db->changeData('username', $user_id, $new_name)){
		                $_SESSION['user'] = $new_name;
		                echo "<div class='alert alert-success' style='display:block; width:800px; text-align:center;.'><strong>Done!</strong> Username changed to $new_name!</div>";
		                $new_name = null;
		            }else{
		                echo "<div class='alert alert-danger' style='display:block; width:300px; text-align:center;'><strong>Warning!</strong> An error occured</div>";
		                $new_name = null;
		            }

		        }else{
		            echo "<div class='alert alert-danger' style='display:block; width:800px; text-align:center;' ><strong>Warning!</strong> Username already taken</div>";
					$new_name = null;
		        }
		    }else{
		        echo "<div class='alert alert-danger' style='display:block; width:300px; text-align:center;'><strong>Warning!</strong> Username too short!</div>";
		    }

	    	}catch(Exception $e){
	    		$er = $e->getMessage();
	    		echo "<div class='alert alert-danger' style='display:block; width:800px; text-align:center;' ><strong>Warning!</strong> $er </div>";
	    	}

		}

		if(isset($_POST['change_password'])){
			$new_pass = Validate::test_input($_POST['new_pass']);
			$new_pass_c = Validate::test_input($_POST['new_pass_conf']);
			if((!isset($new_pass) || strlen($new_pass) > 6 ) && (!isset($new_pass_c) || strlen($new_pass_c) > 6)){

				if ($new_pass == $new_pass_c) {
					if($db->changeData('password', $user_id, $new_pass)){
		                echo "<div class='alert alert-success' style='display:block; width:800px; text-align:center;.'><strong>Done!</strong> Password changed!</div>";
					}else{
	                	echo "<div class='alert alert-danger' style='display:block; width:300px; text-align:center;'><strong>Warning!</strong> An error occured</div>";
					}

				}else{

	            	echo "<div class='alert alert-danger' style='display:block; width:800px; text-align:center;' ><strong>Warning!</strong> Passwords doesn't match!</div>";

				}

			}else{
				echo "<div class='alert alert-danger' style='display:block; width:800px; text-align:center;' ><strong>Warning!</strong> Passwords too short!</div>";
		}
	
		if (isset($_POST['change_email'])) {
		
		}
	}
}
 ?>




  


<div class="container-fluid" >
  <div class="row content" >
    <div class="col-sm-5" style="height: 750px">
      <h1 id='title'>MyNote</h1>
      <h4 id='userTitle'>Welcome, <?php echo $_SESSION['user']; ?>!</h4><br />
      <ul class="nav nav-pills nav-stacked col-sm-3">
        <li><button id="change-username-btn" class="btn btn-info" data-toggle="modal" data-target="#myModalName">Change username</button></li>
        <li><button id="change-pass-btn" class="btn btn-info" data-toggle="modal" data-target="#myModalPass">Change password</button></li>
        <li><button id="change-email-btn" class="btn btn-info" data-toggle="modal" data-target="#myModalEmail">Change email</button></li><br />
        <li><button id="logout_btn" class="btn btn-danger">Log Out</button></li>
      </ul><br>
	
<?php include 'files/modals.php'; ?>




    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" style="display:block;">
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


	function delNote(date) {
		window.location.assign('files/del_note.php/?del=' + date);
	}

</script>
</body>
</html>