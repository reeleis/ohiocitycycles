<?php 
    
       $files = $this->row->file ;

	   foreach($files as $file){

	    echo '<tr>

		           <td>

				       <input name="data[copy_file][]" type="checkbox" checked value="'.$file->path.'" />

				   </td>

				   <td>

				       '.basename($file->path).'

				   </td>

		      </tr>';

	   }

	 ?>