<?php

	use App\data_002914;
	use App\app_mode;

	use App\icons;

	function generate_button($AUTH_mas_id,$PARENT_ID,$DMHA_ID)
	{
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';		

		// ------------------------------------------------------------------------- ACTION
			if(!is_null($PARENT_ID))
			{


				$isi .= '
		        <div class="panel-body text-right">
		        ';
		        
				$PARENT_ID = substr($PARENT_ID, 0, 6);

				$isi_model = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button',$PARENT_ID,1,NULL);

		        foreach ($isi_model as $row) 
		        {	 
		        	if(substr($row->parent_id, 0, 2) == '02' && $row->tipe_data == 1)
		        	{
		        		$kode_unik = str_random(40);
		        		$link = url('/').'/'.$row->link.'/'.$kode_unik;
		        	}
		        	else
		        	{
		        		$link = url('/').'/'.$row->link;
		        	}	
					$isi .= '
					<a href="'.$link.'" class="btn btn-white';

					$isi .= check_active_button($row->dmha_id,$DMHA_ID).'">
					'.convert_me_to_font_awesome($row->icon).'
					'.$row->nama.'
					</a>';
				}

				$isi_model_2 = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button',$PARENT_ID,4,NULL);

				//if(count($isi_model_2) > 0) php 7.1.22
				if(count($isi_model_2) > 0)
				{
					$isi .= '
						<a href="javascript:;" data-toggle="dropdown" class="btn btn-white dropdown-toggle"></a>
						<ul class="dropdown-menu">';
						foreach ($isi_model_2 as $row_2) {					
							$isi .= '<li><a href="'.url('/').'/'.$row_2->link.'"'; 
							$isi .= ' target="_blank" ';
							$isi .=  '> ';

							$isi .= convert_me_to_font_awesome($row_2->icon).' ';

							$isi .= $row_2->nama;

							if($row_2->tipe_data == 8)
							{
								$isi .= ' '.convert_me_to_font_awesome(14);
							}

							$isi .= '</a></li>';
						}
					$isi .= '
						</ul>
					';
				}

				$isi .= '
				</div>
		        ';
		    }
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
			// started : 21 juni 2018
				// convert_me_to_font_awesome FROM ui_sidebar_v2_helper
				// convert_me_to_font_awesome FROM ui_icons
	}

	function check_active_button($DMHA_ID_SIDEBAR,$DMHA_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			$panjang_DMHA_SIDEBAR = strlen($DMHA_ID_SIDEBAR);
			$panjang_DMHA_ID = strlen($DMHA_ID);

			if($panjang_DMHA_SIDEBAR > $panjang_DMHA_ID){
				$DMHA_id_param_1 = substr($DMHA_ID_SIDEBAR, 0, $panjang_DMHA_ID);
				$DMHA_id_param_2 = $DMHA_ID;
			}elseif($panjang_DMHA_SIDEBAR < $panjang_DMHA_ID){
				$DMHA_id_param_1 = $DMHA_ID_SIDEBAR;
				$DMHA_id_param_2 = substr($DMHA_ID, 0, $panjang_DMHA_SIDEBAR);
			}elseif($panjang_DMHA_SIDEBAR == $panjang_DMHA_ID){
				$DMHA_id_param_1 = $DMHA_ID_SIDEBAR;
				$DMHA_id_param_2 = $DMHA_ID;
			}

			if($DMHA_id_param_1 == $DMHA_id_param_2)
			{
				$isi = ' btn-primary ';
			}
			else
			{
				$isi = ' btn-white ';
			}
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	//<a href="#" class="btn btn-primary btn-xs">Extra Small</a>
	function single_link($ORIGN_DMHA_ID,$PARENT_ID,$DMHA_ID,$CUSTOM_ID,$TIPE_DATA){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

			$isi_model 		= data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button',$INIT_param_1->dmha_id,2,8);

		// ------------------------------------------------------------------------- ACTION
			foreach ($isi_model as $row) {
				$isi .= '<a href="'.url('/').'/'.$row->link.'/'.$ORIGN_DMHA_ID.'/'.$CUSTOM_ID.'" class="btn btn-default btn-xs pull-right" target="_blank">'.convert_me_to_font_awesome($row->icon).' '.$row->nama.'</a>';
			}
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	//<button class="btn btn-sm btn-default clickmybutton" value="'.$row->kode_unik.'">'.button_biaya($PARENT_ID,$row->proses_id).'</button>
	function custom_single_button($CLASS,$VALUE,$CUSTOM_ID,$NAME){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

			$isi_model 		= data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button',$INIT_param_1->dmha_id,6,NULL);

		// ------------------------------------------------------------------------- ACTION
			$isi = '<button class="btn btn-sm btn-default clickmybutton" value="'.$row->kode_unik.'"></button>';
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	//<button class="btn btn-sm btn-default clickmybutton" value="'.$row->kode_unik.'">'.button_biaya($PARENT_ID,$row->proses_id).'</button>
	function custom_dropdown_button($CLASS,$VALUE,$CUSTOM_ID,$NAME){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

			$isi_model 		= data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button',$INIT_param_1->dmha_id,6,NULL);

		// ------------------------------------------------------------------------- ACTION
			$isi = '
			<div class="btn-group">
				<a href="#" class="btn btn-default">Dropdown</a>
				<a href="#" class="btn btn-default dropdown-toggle"
			    	data-toggle="dropdown"></a>
				<ul class="dropdown-menu pull-right">
			 		<li><a href="javascript:;">Action 1</a></li>
				</ul>
			</div>
			';
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function generate_button_dropdown($AUTH_mas_id,$PARENT_ID,$CUSTOM_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';
			$isi_model = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button',$PARENT_ID,4,NULL);
		// ------------------------------------------------------------------------- ACTION
			foreach ($isi_model as $row) {					
				$isi .= '<a href="'.url('/').'/'.$row->link.'/'.$CUSTOM_ID.'" class="btn btn-white btn-xs" target="_blank">
				'.convert_me_to_font_awesome($row->icon).' '.$row->nama.' '.convert_me_to_font_awesome(14).'
				</a>';
			}
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function generate_dropdown_button($AUTH_mas_id,$PARENT_ID,$CUSTOM_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';
			$isi_model = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button',$PARENT_ID,2,NULL);
		// ------------------------------------------------------------------------- ACTION
			$isi .= '
			<div class="btn-group">
				<a href="javascript:;" data-toggle="dropdown" class="btn btn-white dropdown-toggle"></a>
				<ul class="dropdown-menu">';
				foreach ($isi_model as $row) {					
					$isi .= '<li><a href="'.url('/').'/'.$row->link.'/'.$CUSTOM_ID.'">'.convert_me_to_font_awesome($row->icon).' '.$row->nama.'</a></li>';
				}
			$isi .= '
				</ul>
			</div>
			';
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function generate_button_table($AUTH_mas_id,$PARENT_ID,$ID)
	{
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';		

			$isi_model = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button',$PARENT_ID,12,NULL);

		// ------------------------------------------------------------------------- ACTION
			foreach ($isi_model as $row) 
			{	
				$link_me = generate_link_to_another_controller($row->tipe,$PARENT_ID,'Query_');

				$isi .= '		        
					<a href="'.url('/').'/'.$link_me.'/'.$row->dmha_id.'/'.$row->data_002911_id.'/'.$ID.'" class="btn btn-white btn-sm">
					'.convert_me_to_font_awesome($row->icon).' '.$row->nama.'
					</a>
		        ';
	    	}
		    
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function generate_button_switcher_on_off($AUTH_mas_id,$PARENT_ID,$DMHA_ID,$ID,$ACTIVE)
	{
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';	

			//$isi_model = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button',$PARENT_ID,12,NULL);

			$isi_model_2 = data_002914::what_is_my_dmha_id($DMHA_ID);
			$link = url('/update_active').'/'.$isi_model_2->link;

		// ------------------------------------------------------------------------- ACTION
			if($ACTIVE == 0)
				{$isi .= '<a href="'.$link.'" class="btn btn-sm btn-white">'.convert_me_to_font_awesome(104).' Off</a>';}
			elseif($ACTIVE == 1)
				{$isi .= '<a href="'.$link.'" class="btn btn-sm btn-primary">'.convert_me_to_font_awesome(106).' On</a>';}

                    /*
			foreach ($isi_model as $row) 
			{	
				$isi .= '	
					<div class="switcher">
                        <input type="checkbox" name="switcher_checkbox_1" id="switcher_checkbox_1" checked="" value="1">
                    </div>	
                    ';
                    /*
                $isi .= '        
					<a href="'.url('/form').'/'.$row->link.'/'.$ID.'" class="btn btn-white btn-sm">
					'.convert_me_to_font_awesome($row->icon).' '.$row->nama.'
					</a>
		        ';
	    	}
	    	*/
		    
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}