<?php
	
	use App\data_002914;
	use App\app_mode;

	use App\icons;


	use App\data_ui;

	use App\data_0004;
	use App\data_06;
	use App\data_14;

	function generate_caret($HAS_SUB){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			if($HAS_SUB == 'has-sub')
			{
				$isi = '<b class="caret"></b>';
			}
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function generate_sub_menu($PARENT_ID,$PARENT_ID_now,$AUTH_MAS_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

			$isi_model = data_002914::what_is_my_parent_id_with_AUTH($PARENT_ID,$AUTH_MAS_ID);
			$isi_model_2 = data_002914::what_is_my_parent_id_with_AUTH($PARENT_ID,$AUTH_MAS_ID);

		// ------------------------------------------------------------------------- ACTION
			if(count($isi_model) > 0 )
			{
				//if(is_null($isi_model->has_sub))
				//{
					$isi .= '<ul class="sub-menu">';
					foreach ($isi_model as $row) {
						$isi .= '<li class="'; 
							if($PARENT_ID_now == $row->dmha_id)
								{$isi .= 'active';} 
						$isi .= '"><a href="'.generate_url($row->dmha_id).'">'.substr($row->nama, 0, 18);

							if($row->kategori == 12) // sidebar counter
							{
								$isi .= generate_sidebar_counter($row->parent_id,$row->dmha_id,$row->tipe);
							}

						$isi .= '</a></li>';				
					}
					$isi .= '</ul>';
				//}
			}
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function generate_sidebar_counter($PARENT_ID,$DMHA_ID,$DMHA_TIPE){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';
			$isi_model = 0;

			$dmha_tipe = generate_dmha_tipe($PARENT_ID,$DMHA_ID,$DMHA_TIPE);

			if($dmha_tipe == '0004')
			{
				$isi_model = data_0004::count($DMHA_ID);
			}

		// ------------------------------------------------------------------------- ACTION
			if($isi_model > 0 )
			{
				$isi .= '<span class="badge pull-right">'.$isi_model.'</span>';		
				
			}
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function generate_sub_user($PARENT_ID,$AUTH_MAS_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

			$isi_model = data_002914::what_is_my_parent_id_with_AUTH($PARENT_ID,$AUTH_MAS_ID);

		// ------------------------------------------------------------------------- ACTION
			if(count($isi_model) > 0 )
			{
				foreach ($isi_model as $row) {
					if($row->nama == 'Edit Profile'){
						$isi .= '<li><a href="'.url('/').'/'.$row->link.'">'.show_me_dmha_icon($row->icon).' '.$row->nama.'</a></li>';				
					}
				}
			}
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}


	function generate_url($DMHA_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

			$isi_model = data_002914::what_is_my_dmha_id($DMHA_ID);

		// ------------------------------------------------------------------------- ACTION
			//if(count($isi_model) > 0) php 7.1.22
			if(!is_null($isi_model))
			{
				if($isi_model->link == 'javascript:;'){
	            	if($isi_model->tipe_data == 6){

	            		$isi_model_2 = data_002914::what_is_my_next_sub_dmha_id($DMHA_ID);

	            		//dd($isi_model_2);
	            		//
	            		//if(count($isi_model_2) > 0) php 7.1.22
						if(!is_null($isi_model_2))
	            		{$isi = url('/').'/'.$isi_model_2->link; }
	            		else
	            		{$isi = '';}
	                }else{
	                	$isi = $isi_model->link;
	                }
	            }else{
	            	$isi = url('/').'/'.$isi_model->link;
	            }
			}
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function check_active_sidebar($DMHA_ID_SIDEBAR,$DMHA_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			if($DMHA_ID_SIDEBAR == substr($DMHA_ID, 0, 4))
			{
				$isi = ' active ';
			}
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}


	// deleted
	function show_me_dmha_icon_DELLETD($ICON_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';


			$ICON_NAME = data_ui::whats_my_icon('1');

			$isi_model = icons::show_me_dmha_icon($ICON_ID,$ICON_NAME);


		// ------------------------------------------------------------------------- ACTION
			if($isi_model != ''){
				if($ICON_NAME == 'ionicon_v421')
				{
					$isi = '<i class="icon '.$isi_model.'"></i>';
				}
				elseif($ICON_NAME == 'ionicons' || $ICON_NAME == 'font_awesome_v4')
				{
					$isi = '<i class="'.$isi_model.'"></i>';
				}
			}
				 
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}
