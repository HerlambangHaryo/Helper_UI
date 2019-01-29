<?php

	use App\data_002914;
	use App\dmha_content;
	use App\app_mode;

	function page_header($DMHA_ID,$DETAIL_TEMPLATE){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			if($DETAIL_TEMPLATE == 'Desktop')
			{
				$isi_model = data_002914::what_is_my_dmha_id($DMHA_ID);

				if(!is_null($isi_model->deskripsi))
					{$isi = '<h1 class="page-header">'.$isi_model->nama.' <small>'.$isi_model->deskripsi.'</small></h1>';}
				else
					{$isi = '<h1 class="page-header">'.$isi_model->nama.'</h1>';}
			}
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function breadcrumb($DMHA_ID,$DETAIL_TEMPLATE,$PARENT_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
				//$isi_model = data_002914::what_is_my_dmha_id($DMHA_ID);
			/*
				$isi_model_2 = data_002914::what_is_my_next_sub_dmha_id($DMHA_ID);

				//if(count($isi_model_2) > 0) php 7.1.22
				if(!is_null($isi_model_2))
					{$isi = '
					<ol class="breadcrumb pull-right">
						<li class="breadcrumb-item"><a href="'.url('dashboard').'">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="'.url($isi_model_2->link).'">'.$isi_model->deskripsi.'</a></li>
						<li class="breadcrumb-item active">'.$isi_model->nama.'</li>
					</ol>
					';}
				else
					{$isi = '
					<ol class="breadcrumb pull-right">
						<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
						<li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
						<li class="breadcrumb-item active">Blank Page</li>
					</ol>
					';}
					*/
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function title_name(){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			$isi = app_mode::whats_my_app_mode();
				
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function header_navigation($AUTH_id,$AUTH_mas_id){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';
			$isi_model = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'user_panel','0025',8,NULL);

		// ------------------------------------------------------------------------- ACTION
			if($isi_model != false)
			{
				$isi .= '
				<!-- begin header-nav -->
				<ul class="navbar-nav navbar-right">
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="'.asset('/public/back/color_admin_v42/').'/assets/img/user/user-12.jpg" alt="" />
							<span class="d-none d-md-inline">'.select_id_data_1_002101($AUTH_id,'name').'
							</span> <b class="caret"></b>
						</a>
						'.sub_header_navigation($AUTH_id,$AUTH_mas_id).'
					</li>
				</ul>
				<!-- end header navigation right -->
				';
			}

			/*
			if($DETAIL_TEMPLATE == 'Desktop')
			{
				$isi .= '
				<!-- begin header-nav -->
				<ul class="navbar-nav navbar-right">
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<span class="d-none d-md-inline">Hi, '.$USERNAME.'</span>
							<img src="'.asset('/public/back/color_admin_v411/').'/assets/img/user/user-12.jpg" alt="" /> 
							<b class="caret"></b>
						</a>
						<div class="dropdown-menu dropdown-menu-right">';
					foreach ($isi_model as $row) {
						$isi .= '<a href="'.url('/').'/'.$row->link.'" class="dropdown-item">'.show_me_dmha_icon($row->icon).' '.$row->nama.'</a>';
					}
				$isi .= '
						</div>
					</li>
				</ul>
				<!-- end header navigation right -->
				';
			}
			*/
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	} 

	function sub_header_navigation($AUTH_id,$AUTH_mas_id){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';
			$isi_model = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button','0025',8,NULL);

		// ------------------------------------------------------------------------- ACTION
			if(count($isi_model) > 0)
			{
				$isi .= '						
					<div class="dropdown-menu dropdown-menu-right">';
				
				foreach ($isi_model as $row) 
				{
					$isi .= '<a href="'.url('/').'/'.$row->link.'" class="dropdown-item">'.convert_me_to_font_awesome($row->icon).' '.$row->nama.'</a>';
				}

				$isi .= '
					</div>
						';	
			}
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	} 

	function generate_dmha_tipe($PARENT_ID,$DMHA_ID,$DMHA_TIPE){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			if($DMHA_TIPE == 1){
				$isi = $DMHA_ID;
			}elseif($DMHA_TIPE == 2){
				$isi = $PARENT_ID;
			}elseif($DMHA_TIPE == 3){
				$isi = substr($DMHA_ID, 0, 4);
			}elseif($DMHA_TIPE == 4){
				$dua_id_awal 	= substr($DMHA_ID,0,2);
				$dua_id_akhir 	= substr($DMHA_ID,-2);

				$isi = $dua_id_awal.'__'.$dua_id_akhir;
			}elseif($DMHA_TIPE == 5){
				$dua_id_awal 	= substr($DMHA_ID,0,2);
				$dua_id_akhir 	= substr($DMHA_ID,-4);

				$isi = $dua_id_awal.'__'.$dua_id_akhir;
			}
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function generate_link_to_another_controller($TIPE_PARAM_1,$PARENT_ID,$PREFIX_LINK){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			if($TIPE_PARAM_1 == 3)
            {
                $custom_parent = substr($PARENT_ID, 0, 4);
            }
            else
            {
                $custom_parent = $PARENT_ID;                
            }
			
		// ------------------------------------------------------------------------- SEND
			$words = $PREFIX_LINK.$custom_parent;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function page_heading($DMHA_ID,$DETAIL_TEMPLATE){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			if($DETAIL_TEMPLATE == 'Desktop')
			{
				$isi_model = data_002914::what_is_my_dmha_id($DMHA_ID);

				if(!is_null($isi_model->deskripsi))
					{$isi = '<h1 class="page-header">'.$isi_model->nama.' <small>'.$isi_model->deskripsi.'</small></h1>';}
				else
					{$isi = '<h1 class="page-header">'.$isi_model->nama.'</h1>';}
			}
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function panel_title($NAME){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			$isi = '			
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title">'.$NAME.'</h4>
			</div>
			';
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function action_width_general(){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '5%';

		// ------------------------------------------------------------------------- ACTION
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function flash_session($STATUS){
		// ------------------------------------------------------------------------- INITIALIZE
			if($STATUS == 'success'){
				$isi = '
				<div class="alert alert-success fade show">
					<span class="close" data-dismiss="alert">×</span>
					<strong>Success!</strong>. 
				</div>
				';
			}elseif($STATUS == 'warning'){
				$isi = '
				<div class="alert alert-warning fade show text-center">
					<span class="close" data-dismiss="alert">×</span>
					<strong>Warning!</strong> '.flash_messages(5).' 
				</div>
				';
			}

		// ------------------------------------------------------------------------- ACTION
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function flash_messages($STATUS){
		// ------------------------------------------------------------------------- INITIALIZE
			if($STATUS == 1){
				return 'Data has been saved successfully.';
			}elseif($STATUS == 2){				
				return 'Data has been deleted successfully.';
			}elseif($STATUS == 3){				
				return 'You do not have privileges to access that page.';
			}elseif($STATUS == 4){				
				return 'Page Not Found.';
			}elseif($STATUS == 5){				
				return 'Are you sure that you want to delete this data?';
			}elseif($STATUS == 6){				
				return 'No record found';
			}elseif($STATUS == 7){				
				return ' is not matching any record';
			}elseif($STATUS == 8){				
				return 'You do not have permission to access this action';
			}elseif($STATUS == 'x'){				
				return 'You have no clue, right?';
			}
		////////////////////////////////////////////////////////////////////////////
	}

	function let_me_know_my_dmha_id($DMHA_ID,$VALUE){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = data_002914::let_me_know_my_dmha_id($DMHA_ID,$VALUE);

		// ------------------------------------------------------------------------- ACTION
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}


	function panel_heading_btn(){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			/*
			$isi = '			
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
			';
			*/

		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function title_print($DMHA_ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			$isi_model = data_002914::what_is_my_dmha_id($DMHA_ID);
			$isi = $isi_model->nama;
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function active_badge($ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';
			
		// ------------------------------------------------------------------------- ACTION
			if($ID == 0)
			{
				$isi .= '<span class="badge badge-secondary">Deactive</span>';
			}
			elseif($ID == 1)
			{				
				$isi .= '<span class="badge badge-primary">Active</span>';
			}
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function active_yes_no($ID){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';

		// ------------------------------------------------------------------------- ACTION
			if($ID == 0)
			{
				$isi .= '<span class="badge badge-secondary">No</span>';
			}
			elseif($ID == 1)
			{				
				$isi .= '<span class="badge badge-primary">Yes</span>';
			}
			
		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

