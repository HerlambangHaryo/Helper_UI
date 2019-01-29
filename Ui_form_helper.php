<?php
    
    use App\pertanyaans;
 
    function open_form($PARENT_ID,$TIPE_PARAM_1,$PARAM_1,$PARAM_2){
        // ------------------------------------------------------------------------- INITIALIZE
            
            $link_me = generate_link_to_another_controller($TIPE_PARAM_1,$PARENT_ID,'Form_');

    		//$isi = '<form class="form-horizontal form-bordered" action="" method="POST">';
            if(!is_null($PARAM_2)){
                $isi = '<form class="form-horizontal form-bordered" action="'.url('/').'/'.$link_me.'/'.$PARAM_1.'/'.$PARAM_2.'" method="POST">';
            }else{                
                $isi = '<form class="form-horizontal form-bordered" action="'.url('/').'/'.$link_me.'/'.$PARAM_1.'" method="POST">';
            }
        // ------------------------------------------------------------------------- ACTION

        // ------------------------------------------------------------------------- SEND
        	$word = $isi;
        	return $word;            
        ////////////////////////////////////////////////////////////////////////////        
    }

    function open_form_enctype(){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '<form class="form-horizontal form-bordered" action="" method="POST" enctype="multipart/form-data">';
        // ------------------------------------------------------------------------- ACTION

        // ------------------------------------------------------------------------- SEND
            $word = $isi;
            return $word;            
        ////////////////////////////////////////////////////////////////////////////        
    }

    function close_form(){
        // ------------------------------------------------------------------------- INITIALIZE
    		$isi = '</form>';
        // ------------------------------------------------------------------------- ACTION

        // ------------------------------------------------------------------------- SEND
        	$word = $isi;
        	return $word;            
        ////////////////////////////////////////////////////////////////////////////        
    }