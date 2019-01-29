<?php

	function submit($VALUE,$NAME,$SUBMIT,$LABEL){
	    // ------------------------------------------------------------------------- INITIALIZE

	      return '
	        <div class="row m-b-10">
	          <div class="col-md-10 offset-md-1">
	            <div class="form-group">
	                <button 
	                type="submit" 
	                class="'.submit_class().'"
	                value="'.$VALUE.'"
	                id="'.$SUBMIT.'"
	                name="'.$NAME.'">
	                	'.$LABEL.'
	                </button>
	            </div>
	          </div>
	        </div>
	      ';

	      /*
	      return '
	      <div class="form-group row">
			<div class="col-md-12">
                <button 
	                type="submit" 
	                class="btn btn-lg btn-block btn-success col-md-10 offset-md-1"
	                value="'.$value.'"
	                id="'.$SUBMIT.'"
	                name="'.$name.'">
	                	Simpan
	            </button>
			</div>
		</div>
	      ';
	      */
	    ////////////////////////////////////////////////////////////////////////////
  	}


	function submit_class(){
	    // ------------------------------------------------------------------------- INITIALIZE
	    	return 'btn btn-lg btn-block btn-success';
	    ////////////////////////////////////////////////////////////////////////////
  	}