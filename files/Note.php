<?php 

class Note {
	public function displayNotes($data = ''){
		if (isset($data)){
			foreach ($data as $key => $value) {

				echo '<div class="row">
						<div class="well" >
	        				<h3>'. $value['title'] .'</h3>
	        				<p>'. $value['body'] .'</p>
	        				<p align="right"><i>'. $value['date'] .'</i></p>
	      				</div>
		      		</div>';
			}
		}
	}
}

