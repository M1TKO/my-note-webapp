<?php 

class Note {
	public function displayNotes($data = ''){
		if (isset($data)){
			foreach ($data as $key => $value) {

				echo '<div class="row">
						<div class="well" >
						 <button type="button" class="close" style="color:red; font-size:45px;" onclick="delNote(\''. $value['date'] .'\')">&times;</button>
	        				<h3 id="note-cont">'. $value['title'] .'</h3>
	        				<p id="note-cont">'. $value['body'] .'</p>
	        				<p align="right"><i>'. $value['date'] .'</i></p>
	      				</div>
		      		</div>';
			}
		}
	}
}

