<?php

	use App\pengurusan;
	
	use App\berkas;
	use App\sumber_data_pengisian;
	use App\data_02;

	use App\pertanyaans_n_dmhas;
	use App\dmha_n_dmhas;
	use App\ktps;
	
	use App\tarot_decks;
	use App\pengaturan_02;

	
	function unlimited_tabs_ver_3($dmha_id,$tipe_data,$form_param_1,$PARAMETER_ID)
	{
		// -------------------------------------------------------------------------------------------- dd test
		// dd($dmha_id.'#'.$tipe_data.'#'.$form_param_1.'#'.$PARAMETER_ID);
		// dd($form_param_1);

		// -------------------------------------------------------------------------------------------- define your model
			$model_tabs = '';

			if(substr($dmha_id, 0, 2) == '02' && $form_param_1 == 2) 
			{	
				// ------------------------------------------------------------------------ pengecekan optimisasi kop surat
					$pengecualian_sdp = pengaturan_02::where('parent_id','like',substr($dmha_id, 0, 4))
													->value('optimisasi_data_kop_surat');

					$final_cari_sdp = 'dmha_n_dmhas.parent_id like "'.substr($dmha_id, 0, 4).'" ';

					$status_pengecualian = FALSE;

					if(!is_null($pengecualian_sdp) && $pengecualian_sdp == 1)
					{
						$status_pengecualian = TRUE;
					}

				// ------------------------------------------------------------------------ pengecekan optimisasi kop surat
					$pengecualian_sdp2 = pengaturan_02::where('parent_id','like',substr($dmha_id, 0, 4))
													->value('optimisasi_tanggal_surat');

					$final_cari_sdp = 'dmha_n_dmhas.parent_id like "'.substr($dmha_id, 0, 4).'" ';

					$status_pengecualian2 = FALSE;

					if(!is_null($pengecualian_sdp2) && $pengecualian_sdp2 == 1)
					{
						$status_pengecualian2 = TRUE;
					}

				// ------------------------------------------------------------------------ final cari sdp
					if($status_pengecualian == TRUE && $status_pengecualian2 == TRUE)
					{
						$final_cari_sdp .= ' AND sumber_data_pengisians.id NOT IN (11,5) ';
					}
					elseif($status_pengecualian == TRUE)
					{
						$final_cari_sdp .= ' AND sumber_data_pengisians.id != 11 ';
					}
					elseif($status_pengecualian2 == TRUE)
					{
						$final_cari_sdp .= ' AND sumber_data_pengisians.id != 5 ';
					}

				$model_tabs = pertanyaans_n_dmhas::select('sumber_data_pengisians.nama','sumber_data_pengisians.id','sumber_data_pengisians.multi_data')
					->join('dmha_n_dmhas','dmha_n_dmhas.dmha_ids','=','pertanyaans_n_dmhas.dmha_id')

					->join('pertanyaans','pertanyaans.id','=','pertanyaans_n_dmhas.pertanyaan_id')
					->join('sumber_data_pengisians','sumber_data_pengisians.id','=','pertanyaans.sumber_data_pengisian_id')

					//->where('dmha_n_dmhas.parent_id','like',substr($dmha_id, 0, 4))
					->whereRaw($final_cari_sdp)							
					->whereNull('pertanyaans.deleted_at')
					->groupBy('sumber_data_pengisians.nama')
					->groupBy('sumber_data_pengisians.id')
					->orderBy('sumber_data_pengisians.urutan','asc')
					->get();

			}
			else
			{
				//dd('hai');
				// visit grand parent first
				$grand_parent_id = substr($dmha_id, 0, 2);
				// dd($grand_parent_id);

				$model_tabs = pertanyaans_n_dmhas::select('sumber_data_pengisians.nama','sumber_data_pengisians.id','sumber_data_pengisians.multi_data')
							->join('pertanyaans','pertanyaans.id','=','pertanyaans_n_dmhas.pertanyaan_id')
							->join('sumber_data_pengisians','sumber_data_pengisians.id','=','pertanyaans.sumber_data_pengisian_id')
							->where('pertanyaans_n_dmhas.grand_parent_id','like',$grand_parent_id)
							->where('sumber_data_pengisians.dihapus','=','0')							
							->whereNull('pertanyaans.deleted_at')
							->groupBy('sumber_data_pengisians.nama')
							->groupBy('sumber_data_pengisians.id')
							->get();
							
				// dd($model_tabs);
				//dd(is_null($model_tabs));
				//dd(isset($model_tabs));
				//dd(empty($model_tabs));
				//dd(count($model_tabs));

				// visit parent
				if(count($model_tabs) == 0)
				{
					$parent_id = substr($dmha_id, 0, 4);

					$model_tabs = pertanyaans_n_dmhas::select('sumber_data_pengisians.nama','sumber_data_pengisians.id','sumber_data_pengisians.multi_data')
							->join('pertanyaans','pertanyaans.id','=','pertanyaans_n_dmhas.pertanyaan_id')
							->join('sumber_data_pengisians','sumber_data_pengisians.id','=','pertanyaans.sumber_data_pengisian_id')
							->where('pertanyaans_n_dmhas.parent_id','like',$parent_id)
							->where('sumber_data_pengisians.dihapus','=','0')							
							->whereNull('pertanyaans.deleted_at')
							->groupBy('sumber_data_pengisians.nama')
							->groupBy('sumber_data_pengisians.id')
							->get();

					//dd('haia'.$parent_id);
					// dd(is_null($model_tabs));

					// visit dmha id
					if(count($model_tabs) == 0)
					{
						$model_tabs = pertanyaans_n_dmhas::select('sumber_data_pengisians.nama','sumber_data_pengisians.id','sumber_data_pengisians.multi_data')
								->join('pertanyaans','pertanyaans.id','=','pertanyaans_n_dmhas.pertanyaan_id')
								->join('sumber_data_pengisians','sumber_data_pengisians.id','=','pertanyaans.sumber_data_pengisian_id')
								->where('pertanyaans_n_dmhas.dmha_id','like',$dmha_id)
								->where('sumber_data_pengisians.dihapus','=','0')							
								->whereNull('pertanyaans.deleted_at')
								->groupBy('sumber_data_pengisians.nama')
								->groupBy('sumber_data_pengisians.id')
								->get();

								dd('haia=b');
						if(count($model_tabs) == 0)
						{
							$dua_id_awal = substr($dmha_id,0,2);
							$dua_id_akhir = substr($dmha_id,-2);

							//dd($dua_id_awal.'__'.$dua_id_akhir);

							$model_tabs = pertanyaans_n_dmhas::select('sumber_data_pengisians.nama','sumber_data_pengisians.id','sumber_data_pengisians.multi_data')
								->join('pertanyaans','pertanyaans.id','=','pertanyaans_n_dmhas.pertanyaan_id')
								->join('sumber_data_pengisians','sumber_data_pengisians.id','=','pertanyaans.sumber_data_pengisian_id')
								->where('pertanyaans_n_dmhas.dmha_id','like',$dua_id_awal.'__'.$dua_id_akhir)
								->where('sumber_data_pengisians.dihapus','=','0')							
								->whereNull('pertanyaans.deleted_at')
								->groupBy('sumber_data_pengisians.nama')
								->groupBy('sumber_data_pengisians.id')
								->get();

							//dd($model_tabs);
						}
					}
				}
			}

			//dd($model_tabs);
			

	        if ($form_param_1 == 2)
	        {
	          $submit_multi_data = TRUE;
	        }
	        elseif($form_param_1 == 1)
	        {
	          $submit_multi_data = FALSE;
	        }
		


		// -------------------------------------------------------------------------------------------- dd test
		// dd($model_tabs);

		// 1 tambah // 2 ubah
		if($tipe_data == '1' || $tipe_data == '2' || $tipe_data == '3')
		{
			echo '<form class="form-horizontal form-bordered" method="POST">';
	        echo csrf_field();
		}

		echo '
		<!-- begin row -->
		<div class="row">
		    <!-- begin col-12 -->
		    <div class="col-md-12">
		        <!-- begin panel -->
		        <div class="panel panel-inverse panel-with-tabs" data-sortable-id="ui-unlimited-tabs-1">
		            <div class="panel-heading p-0">
		                <div class="panel-heading-btn m-r-10 m-t-10">
		                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-expand"><i class="fa fa-expand"></i></a>
		                </div>
		                <!-- begin nav-tabs -->
		                <div class="tab-overflow">
		                    <ul class="nav nav-tabs nav-tabs-inverse">
		                        <li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-success"><i class="fa fa-arrow-left"></i></a></li>';

		                $counter = 0;
		                if(!empty($model_tabs))
		                {
		                	// dd('im here');
		                    foreach ($model_tabs as $tabs) 
		                    {
		                    	// dd('im here');
		                    	$counter++;
		                    	echo '
		                        <li class="';if($counter == 1){ echo ' active ';} echo ' "><a href="#nav-tab-'.$counter.'" data-toggle="tab">'.$tabs->nama.' '.$tabs->id.'</a></li>';
		                    }
		                }else{
		                	echo '
		                        <li class="active"><a href="#nav-tab-1" data-toggle="tab">'.$dmha_id.'</a></li>';
		                }
		                        

		                        echo '
		                        <li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-success"><i class="fa fa-arrow-right"></i></a></li>
		                    </ul>
		                </div>
		            </div>
		            <div class="tab-content">';

		        $counter = 0;
             	if(!empty($model_tabs))
                {	
                	// dd('im here');
                    foreach ($model_tabs as $tabs) 
                    {
                    	// dd('im here');
                    	$counter++;
                    	echo '
		                <div class="tab-pane fade '; if($counter == 1){echo 'active in';} echo ' " id="nav-tab-'.$counter.'">';

		                if($tabs->multi_data == 5)
		                {
		                	$tanggal_model = dmha_n_dmhas::join('daftar_multi_hak_akses','daftar_multi_hak_akses.dmha_id','dmha_n_dmhas.dmha_ids')
		                								->where('dmha_n_dmhas.parent_id','like',substr($dmha_id, 0, 4))->get();

		                	foreach ($tanggal_model as $row) {
		                		echo input_type($tipe_data,$dmha_id,$tabs->id,$PARAMETER_ID,$form_param_1,$row->nama,$row->dmha_ids);
		                	}
		                }
		                elseif($tabs->multi_data != 0)
		                {
		                	$href_link = str_replace(' ', '_', $tabs->nama);

		                	echo accordion_unlimited_tabs($dmha_id,$PARAMETER_ID,$tabs->id);

		                	echo modal_dialog_auto($dmha_id,$PARAMETER_ID,$tabs->id,'NUL','NUL','NUL',1);

		                	//$sdp = check_sdp_in_data_02($dmha_id,$PARAMETER_ID,$sumber_data_pengisian_id);

		                	if($tipe_data == 1)
		                	{
		                		$temp_data = data_02::where('dmha_id','like',substr($dmha_id, 0, 4))
		                							->where('kode_unik','like',$PARAMETER_ID)
		                							->where('sumber_data_pengisian_id','=',$tabs->id)
		                							->get();		                		
		                	}
		                	elseif($tipe_data == 2)
		                	{
		                		$temp_data = data_02::where('dmha_id','like',substr($dmha_id, 0, 4))
		                							->where('berkas_id','=',$PARAMETER_ID)
		                							->where('sumber_data_pengisian_id','=',$tabs->id)
		                							->get();
		                	}


		                	if(!empty($temp_data))
		                	{
		                		foreach ($temp_data as $temp) {
		                			echo modal_dialog_auto($dmha_id,$PARAMETER_ID,$tabs->id,$temp->berkas_data_id,$temp->helper1,$temp->helper2,2);
		                		}
		                	}
		                }
		                else // = 0
		                {
		                	// if(substr($dmha_id, 0 , 2) == '02')
		                	// {
		                	// 	$form_param_1 = 1;
		                	// }

		                	echo input_type($tipe_data,$dmha_id,$tabs->id,$PARAMETER_ID,$form_param_1,NULL,NULL);
		                }                

		                echo '
		                </div>';
                    }
                }else{
                	echo '
		                <div class="tab-pane fade active in" id="nav-tab-1">
		                	Please make '.$dmha_id.' in unlimited tabs helper
		                </div>';
                }
		            	

		            echo '
		            </div>
		        </div>
		        <!-- end panel -->
		    </div>
		    <!-- end col-12 -->
		</div>
		<!-- end row -->
		';

		if($tipe_data == '1' || $tipe_data == '2' || $tipe_data == '3')
		{
			if($submit_multi_data == TRUE)
			{
				echo submit('multi_submit','multi_submit');
			}else{
				echo submit('final_submit','final_submit');
			}
			
			echo '</form>';;
		}

	}

