<?php

	function data_card_accordion_open($NAMA,$COUNTER,$DATA_PARENT){
	    // ------------------------------------------------------------------------- INITIALIZE
			$isi = '';
			$random = str_random(3);

	    // ------------------------------------------------------------------------- ACTION
			$isi .= '<div class="card">';
			$isi .= '<div class="card-header  pointer-cursor';
			if($COUNTER != 1){
				$isi .= ' collapsed ';
			}
			$isi .= '" data-toggle="collapse" data-target="#collapse'.$random.'">';
			$isi .= $NAMA;
			$isi .= '</div>';
			$isi .= '<div id="collapse'.$random.'" class="collapse ';
			if($COUNTER == 1){
				$isi .= ' show ';
			}
			$isi .= '" data-parent="#accordion'.$DATA_PARENT.'">';
			$isi .= '<div class="card-body">';

	    // ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function data_card_accordion_close(){
	    // ------------------------------------------------------------------------- INITIALIZE
	    	$isi = '</div> </div> </div> ';

	    // ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function accordion_open($random){
	    // ------------------------------------------------------------------------- SEND
	    	$isi = '<div id="accordion'.$random.'" class="card-accordion">';

	    // ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
	    ////////////////////////////////////////////////////////////////////////////
  	}

  	function accordion_close(){
	    // ------------------------------------------------------------------------- SEND
	    	$isi = '</div>';

	    // ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
	    ////////////////////////////////////////////////////////////////////////////
  	}