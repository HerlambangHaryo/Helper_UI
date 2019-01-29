<?php
	use App\data_002914;

	function show_the_user_panel($AUTH_id,$AUTH_mas_id){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';
			$isi_model = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'user_panel','0025',8,NULL);

		// ------------------------------------------------------------------------- ACTION
			if($isi_model != false)
			{
				$isi .= '			
					<!-- begin sidebar user -->
					<ul class="nav">
						<li class="nav-profile">
							<a href="javascript:;" data-toggle="nav-profile">
								<div class="cover with-shadow"></div>
								<div class="image">
									<img src="'.asset('/public/back/color_admin_v42/').'/assets/img/user/user-12.jpg" alt="" />
								</div>
								<div class="info">
									<b class="caret pull-right"></b>			
										'.select_id_data_1_002101($AUTH_id,'name').'
									<small>							
										'.select_id_data_1_002120($AUTH_mas_id,'nama').'
									</small>
									<small>							
										'.sum_final_score_1_0004().' Exp
									</small>
								</div>
							</a>
						</li>
						'.show_the_sub_user_panel($AUTH_id,$AUTH_mas_id).'
					</ul>
					<!-- end sidebar user -->
				';
			}

		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}

	function show_the_sub_user_panel($AUTH_id,$AUTH_mas_id){
		// ------------------------------------------------------------------------- INITIALIZE
			$isi = '';
			$isi_model = data_002914::let_me_check_what_is_your_credential($AUTH_mas_id,'button','0025',8,NULL);

		// ------------------------------------------------------------------------- ACTION
			if(count($isi_model) > 0)
			{
				$isi .= '			
					<li>
						<ul class="nav nav-profile">';

				foreach ($isi_model as $row) 
				{
					$isi .= '<li><a href="'.url('/').'/'.$row->link.'">'.convert_me_to_font_awesome($row->icon).' '.$row->nama.'</a></li>';
				}

				$isi .= '
						</ul>
					</li>
				';
			}
			

		// ------------------------------------------------------------------------- SEND
			$words = $isi;
			return $words;
		////////////////////////////////////////////////////////////////////////////
	}