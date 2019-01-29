<?php

	use App\data_002912;

	function convert_me_to_font_awesome($ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$words = show_me_font_awesome(data_002912::read_data_by_id($ID,'nama'));
		// ------------------------------------------------------------------------- SEND
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function show_me_font_awesome($ICON){
		// ------------------------------------------------------------------------- INITIALIZE
			$words = '<i class="'.$ICON.'"></i>';
		// ------------------------------------------------------------------------- SEND
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function show_me_font_awesome_3x($ICON){
		// ------------------------------------------------------------------------- INITIALIZE
			$words = '<i class="'.$ICON.' fa-3x"></i>';
		// ------------------------------------------------------------------------- SEND
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}