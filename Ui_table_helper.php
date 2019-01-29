<?php

	function data_tabel_open(){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
	        <div class="table-responsive">
				<!-- begin widget-table -->
				<table class="table table-bordered widget-table widget-table-rounded table-striped table-hover scroll" id="table">
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}

	function data_tabel_open_without_id(){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
	        <div class="table-responsive">
				<!-- begin widget-table -->
				<table class="table table-bordered widget-table widget-table-rounded table-striped table-hover scroll">
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function data_tabel_close(){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
				</table>
				<!-- end widget-table -->
			</div>
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function data_tabel_open_with_id($ID){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
	        <div class="table-responsive">
				<!-- begin widget-table -->
				<table class="table table-bordered widget-table widget-table-rounded table-striped table-hover" id="'.$ID.'">
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function no_data_table($coloumn){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
			<tr><td class="text-center" colspan="'.$coloumn.'">No Record Data</td></tr>
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function th_me($title){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
			<th>
			'.$title.'
			</th>
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function td_me($title){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
			<td>
			'.$title.'
			</td>
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function td_class_me($class,$title){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
			<td class="'.$class.'">
			'.$title.'
			</td>
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function td_class_colspan_me($class,$colspan,$title){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
			<td class="'.$class.'" colspan="'.$colspan.'">
			'.$title.'
			</td>
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function col_loop($Xtimes){
	    // ------------------------------------------------------------------------- INITIALIZE
	    	$x = 1; 
	    	$isi = '';

			while($x <= $Xtimes) {
	    		$isi .= '<col>';
			    $x++;
			} 

			$words = $isi;
			return $words;
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function table_data_notification(){
	    // ------------------------------------------------------------------------- INITIALIZE
	      return '
			<tbody>
				<tr>
					<td class="text-center">
						Please, Make your data helper
					</td>
				<tr>
			</tbody>
	      ';
	    ////////////////////////////////////////////////////////////////////////////
  	}