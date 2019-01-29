<?php

  use App\pengurusan;
  use App\data_002914;
  use App\pertanyaans;
  use App\sumber_data_pengisians;
  use App\pengaturan;

  //ext model
  use App\agama;
  use App\batas_pengecualian;
  use App\dasar_peralihan;
  use App\kewarganegaraan;
  use App\macam_alas_hak;
  use App\status_tanah;
  use App\wilayah_kecamatans;
  use App\wilayah_kelurahans;
  use App\wilayah_kotas;
  use App\wilayah_provinsi;
  use App\dmha_status;
  use App\font_awesome;
  use App\dmha_css;
  use App\dmha_js;
  use App\dmha_tipe_datas;

  use App\pertanyaans_n_dmhas;

  use App\tarot_decks;
  use App\dmha_kategoris;
  use App\dmha_forms;
  use App\penggunaan_tanahs;
  use App\finance_categories;
  use App\bg_colors;
  use App\tipe_pertanyaans;
  use App\ktps;
  use App\pengaturan_02;

  function input_type($tipe_data,$dmha_id,$sumber_data_pengisian_id,$PARAMETER_ID,$form_param_1,$custom_label,$value_helper_parameter)
  {
    /* Helper Guide lines
      1. Menentukan value, apakah form tambah / ubah
      2. Parameter Query data pertanyaaan
      3. Parameter
      4. ID bantu untuk value
      5. Menentukan Pertanyaan dan Helper name
      6. Mengganti Nama Label
      7. Memberikan Value Untuk Helper name
    */
    // -------------------------------------------------------------------------------------------------------- INITIALIZE
        $panjang_label = ' col-md-3 ';
        $label_align = ' text-left ';
        $name_form = '';
        $isi = '';

        //dd($form_param_1);

    // ------------------------------------------------------------------------------------------------------- MODEL TABS
        //dd($dmha_id);
        if(substr($dmha_id, 0, 2) == '02' && $form_param_1 == 2) 
        {
          $model_tabs = pertanyaans_n_dmhas::selectRaw('
            pertanyaans.id, 
            pertanyaans.nama,  
            pertanyaans.name,
            pertanyaans.panjang_field, 
            pertanyaans.tipe_pertanyaan_id, 
            pertanyaans.required,
            pertanyaans.sumber_data_pengisian_id,
            pertanyaans.id_acuan2,
            pertanyaans.class_pertanyaans,
            tipe_pertanyaans.class,
            tipe_pertanyaans.input_type,
            tipe_pertanyaans.jquery')
                   ->join('dmha_n_dmhas','dmha_n_dmhas.dmha_ids','=','pertanyaans_n_dmhas.dmha_id')                   
                   ->join('pertanyaans', 'pertanyaans.id', '=', 'pertanyaans_n_dmhas.pertanyaan_id')
                   ->join('tipe_pertanyaans', 'tipe_pertanyaans.id', '=', 'pertanyaans.tipe_pertanyaan_id')
                   ->where('dmha_n_dmhas.parent_id','like',substr($dmha_id, 0, 4))
                   ->where('pertanyaans.sumber_data_pengisian_id','=',$sumber_data_pengisian_id)             
                   ->whereNull('pertanyaans.deleted_at')
                   ->groupBy('pertanyaans.id')
                   ->orderBy('pertanyaans.urutan','ASC')
                   ->get();

          //dd($sumber_data_pengisian_id);
        }
        else
        {
          // visit grand parent first
          $grand_parent_id = substr($dmha_id, 0, 2);

          $model_tabs = pertanyaans_n_dmhas::selectRaw('
            pertanyaans.id, 
            pertanyaans.nama,  
            pertanyaans.name,
            pertanyaans.panjang_field, 
            pertanyaans.tipe_pertanyaan_id, 
            pertanyaans.required,
            pertanyaans.sumber_data_pengisian_id,
            pertanyaans.id_acuan2,
            pertanyaans.class_pertanyaans,
            tipe_pertanyaans.class,
            tipe_pertanyaans.input_type,
            tipe_pertanyaans.jquery')
                   ->join('pertanyaans', 'pertanyaans.id', '=', 'pertanyaans_n_dmhas.pertanyaan_id')
                   ->join('tipe_pertanyaans', 'tipe_pertanyaans.id', '=', 'pertanyaans.tipe_pertanyaan_id')
                   ->where('pertanyaans_n_dmhas.grand_parent_id','like',$grand_parent_id)             
                   ->whereNull('pertanyaans.deleted_at')
                   ->orderBy('pertanyaans.urutan','ASC')
                   ->get();

           //dd(is_null($model));

          // visit parent
          if(count($model_tabs) == 0)
          {
            $parent_id = substr($dmha_id, 0, 4);

            $model_tabs = pertanyaans_n_dmhas::selectRaw('pertanyaans.id, 
            pertanyaans.nama, 
            pertanyaans.name,
            pertanyaans.panjang_field, 
            pertanyaans.tipe_pertanyaan_id, 
            pertanyaans.required,
            pertanyaans.sumber_data_pengisian_id,
            pertanyaans.id_acuan2,
            pertanyaans.class_pertanyaans,
            tipe_pertanyaans.class,
            tipe_pertanyaans.input_type,
            tipe_pertanyaans.jquery')
                   ->join('pertanyaans', 'pertanyaans.id', '=', 'pertanyaans_n_dmhas.pertanyaan_id')
                   ->join('tipe_pertanyaans', 'tipe_pertanyaans.id', '=', 'pertanyaans.tipe_pertanyaan_id')
                   ->where('pertanyaans_n_dmhas.parent_id','like',$parent_id)             
                   ->whereNull('pertanyaans.deleted_at')
                   ->orderBy('pertanyaans.urutan','ASC')
                   ->get();

            // visit dmha id
            if(count($model_tabs) == 0)
            {
              $model_tabs = pertanyaans_n_dmhas::selectRaw('pertanyaans.id, 
            pertanyaans.nama, 
            pertanyaans.name, 
            pertanyaans.panjang_field, 
            pertanyaans.tipe_pertanyaan_id, 
            pertanyaans.required,
            pertanyaans.sumber_data_pengisian_id,
            pertanyaans.id_acuan2,
            pertanyaans.class_pertanyaans,
            tipe_pertanyaans.class,
            tipe_pertanyaans.input_type,
            tipe_pertanyaans.jquery')
                     ->join('pertanyaans', 'pertanyaans.id', '=', 'pertanyaans_n_dmhas.pertanyaan_id')
                     ->join('tipe_pertanyaans', 'tipe_pertanyaans.id', '=', 'pertanyaans.tipe_pertanyaan_id')
                     ->where('pertanyaans_n_dmhas.dmha_id','like',$dmha_id)             
                     ->whereNull('pertanyaans.deleted_at')
                     ->orderBy('pertanyaans.urutan','ASC')
                     ->get();

              if(count($model_tabs) == 0)
              {

                $dua_id_awal = substr($dmha_id,0,2);
                $dua_id_akhir = substr($dmha_id,-2);

                $model_tabs = pertanyaans_n_dmhas::selectRaw('pertanyaans.id, 
                pertanyaans.nama, 
                pertanyaans.name, 
                pertanyaans.panjang_field, 
                pertanyaans.tipe_pertanyaan_id, 
                pertanyaans.required,
                pertanyaans.sumber_data_pengisian_id,
                pertanyaans.id_acuan2,
                pertanyaans.class_pertanyaans,
                tipe_pertanyaans.class,
                tipe_pertanyaans.input_type,
                tipe_pertanyaans.jquery')
                         ->join('pertanyaans', 'pertanyaans.id', '=', 'pertanyaans_n_dmhas.pertanyaan_id')
                         ->join('tipe_pertanyaans', 'tipe_pertanyaans.id', '=', 'pertanyaans.tipe_pertanyaan_id')
                         ->where('pertanyaans_n_dmhas.dmha_id','like',$dua_id_awal.'__'.$dua_id_akhir)             
                         ->whereNull('pertanyaans.deleted_at')
                         ->orderBy('pertanyaans.urutan','ASC')
                         ->get();
              }
            }
          }
        }

    // -------------------------------------------------------------------------------------------------- GENERATING DATA
        //dd($form_param_1);
        //dd($tipe_data);
        //dd($PARAMETER_ID);
        //dd($dmha_id);
        //dd($model_tabs);
        //dd(session()->all());

        // ---------------------------------------------------------------------------- kalau datanya ADA
          if(!empty($model_tabs))
          {
            foreach ($model_tabs as $row) 
            {
              $testing = $row->id;
              // ------------------------------------------------------------ value ID
                $value_id                                   = $row->id;
                $VALUE_final_helper						= '';
              
              
              // ----------------------------------------------- Set FORM / MULTI FORM
                // ---------------------------------------- FORM
                  if($form_param_1 == 1)
                  {
                    $set_name_form                                = ' name="'.$row->name.'" ';
                  }
                // ---------------------------------- MUTLI FORM
                  elseif($form_param_1 == 2)
                  {
                    $sdp_model = sumber_data_pengisians::where('id','=',$row->sumber_data_pengisian_id)->first();

                    $sdp_model_multi_data = $sdp_model->multi_data;

                    // ------------------ tanpa tabel
                      if($sdp_model->multi_data == 0 || $sdp_model->multi_data == 5)
                      {      
                        $custom_id                                  = '';

                        if($tipe_data == 2 || $tipe_data == 3)
                        {
                          $kode_unik_khusus_value                     = NULL;
                          $PARAMETER_ID_khusus_value                  = $PARAMETER_ID;
                          $sumber_data_pengisian_id_khusus_value      = 0;
                          $berkas_data_id_khusus_value                = null;
                          
                          $helper1_khusus_value                     = '';
                          $helper2_khusus_value                     = '';
                        }
                      }
                    // ------------------ pakai tabel
                      elseif($sdp_model->multi_data != 0)
                      {
                        
                          $custom_id                                = $PARAMETER_ID.'_';

                          //$empat = $satu.'#'.$row->kode_unik.'#'.$row->berkas_id.'#'.$row->sumber_data_pengisian_id.'#'.$row->berkas_data_id.'#'.$helper1.'#'.$helper2;
                          $explode_parameter                        = explode('#', $PARAMETER_ID);
                          $kode_unik_khusus_value                   = $explode_parameter[1];
                          $PARAMETER_ID_khusus_value                = $explode_parameter[2];
                          $sumber_data_pengisian_id_khusus_value    = $explode_parameter[3];
                          $berkas_data_id_khusus_value              = $explode_parameter[4];
                          $helper1_khusus_value                     = $explode_parameter[5];
                          $helper2_khusus_value                     = $explode_parameter[6];

                          // -------------------------------------------------------------- Set ID
                          if($tipe_data == 2 || $tipe_data == 3)
                          {
                            $value_id                                   = $sumber_data_pengisian_id.''.$berkas_data_id_khusus_value.''.$row->id; 
                          }
                      }  

                    // ------------------ khusus tanggal
                      if(!is_null($value_helper_parameter))
                      {
                        $helper1_khusus_value                     = 'tanggal';
                        $VALUE_final_helper                     = $value_helper_parameter;
                      }

                    // inisialisasi name_form
                      $sdp_nama                                     = $custom_id;
                      $set_name_form                                = ' name="'.$sdp_nama.'isi[]" ';
                      $pertanyaans_name                             = 'name="'.$sdp_nama.'pertanyaan_id[]"';
                      $helpers_name                                 = 'name="'.$sdp_nama.'helper[]"';   
                  }

              // ---------------------------------------------------------- Set tag ID
                $set_tag_id                                 = ' id="'.$value_id.'" ';
                  
              // ----------------------------------------------------------- Set CLASS
                $multi_input_type_class_name        = ' class=" ';

                // ------------------------------------------------- General
                  $multi_input_type_class_name     .= ' form-control ';

                // ------------------------------------------------ Specific
                  $multi_input_type_class_name     .= $row->class;

                // ----------------------------------------------- Auto_nama
                  $multi_input_type_class_name     .= ' auto_'.$row->tipe_pertanyaan_id;

                // ------------------------------------------------ Specific
                  $multi_input_type_class_name     .= ' '.$row->class_pertanyaans;

                // ----------------------------------------- tag class close
                  $multi_input_type_class_name     .= '" ';

              // ------------------------------------------------------- Set mini ATTR
                // ------------------------------------ Set autocomplete
                  $exception_using_value = array('1','4','5','3');
                      // 1. text
                      // 4. add on m2
                      // 5. add on Rp
                      // 3. Textarea

                    if(in_array($row->input_type, $exception_using_value))
                    {
                      //$auto_complete_tag              = 'autocomplete="off"';
                      $auto_complete_tag              = '';
                    }
                    else
                    {
                      $auto_complete_tag              = '';
                    }

                // ---------------------------------------- Set Required
                  if($row->required == '0')
                  {
                    $required                     = '';
                  }
                  elseif($row->required == '1')
                  {
                    $required                     = ' required ';
                  }

              // ------------------------------------------------- Radio type Exception
                if($row->input_type == 6 || $row->input_type == 7 || $row->input_type == 9)
                {
                  $multi_input_type_class_name = '';
                }

              // ------------------------------------------------------ Set ATTRIBUTES
                $multi_attributes               = $set_tag_id
                                                . $multi_input_type_class_name
                                                . $set_name_form
                                                . $auto_complete_tag
                                                . $required
                                                ;

              // --------------------------------------------------- Generating Value
                if($tipe_data == 2 || $tipe_data == 3)
                {
                  $pengecualian_versi_1 = array('020102','020103');
                  $pengecualian_versi_2 = array('0303','0304');


                  if(in_array($dmha_id, $pengecualian_versi_1))
                  {
                    $value 			= isi_data_details(substr($dmha_id, 0, 4),$kode_unik_khusus_value,$PARAMETER_ID_khusus_value,$sumber_data_pengisian_id_khusus_value,$berkas_data_id_khusus_value,$row->id,$helper1_khusus_value,$helper2_khusus_value,FALSE,'isi',NULL);
                   

                    // $value =  ' 1.'.substr($dmha_id, 0, 4).
                    //           ' 2.'.$kode_unik_khusus_value.
                    //           ' 3.'.$PARAMETER_ID_khusus_value.
                    //           ' 4.'.$sumber_data_pengisian_id_khusus_value.
                    //           ' 5.'.$berkas_data_id_khusus_value.
                    //           ' 6.'.$row->id.
                    //           ' 7.1'.
                    //           ' 8.2'.
                    //           ' 9.FALSE'.
                    //           ' 10.isi';

                    //$value = 'hai';
                    //$value = substr($dmha_id, 0, 4).'-'.$kode_unik_khusus_value.'-'.$PARAMETER_ID_khusus_value.'-'.$sumber_data_pengisian_id_khusus_value.'-'.$berkas_data_id_khusus_value.'-'.$row->id.'-'.$helper1_khusus_value.'-'.$helper2_khusus_value.'-FALSE-'.'isi'.'-NULL';

                    //$value = $tipe_data.'-'.$dmha_id.'-'.$sumber_data_pengisian_id.'-'.$PARAMETER_ID.'-'.$form_param_1.'-'.$custom_label.'-'.$value_helper_parameter;
                    //$value = $sumber_data_pengisian_id_khusus_value;
                    //$value = $sdp_model->multi_data;
                    //$value = $sdp_model_multi_data;
                    //$value = $PARAMETER_ID_khusus_value;
                    //$value = $PARAMETER_ID;
                    //$value = $tipe_data;
                    //$value = $kode_unik_khusus_value;
                    //$value = $berkas_data_id_khusus_value;

                  }
                  elseif(in_array($dmha_id, $pengecualian_versi_2))
                  {
                    $value = isi_data_details($dmha_id,$kode_unik_khusus_value,$PARAMETER_ID_khusus_value,$sumber_data_pengisian_id_khusus_value,NULL,$row->id,1,2,FALSE,'isi');
                    //$value = '';
                  }
                  else
                  {
                    // if(in_array($row->input_type, $exception_using_value))
                    // {
                    //   $value = isi_form_new($dmha_id,$PARAMETER_ID,$testing);                    
                    // }
                    $value = isi_form_new($dmha_id,$PARAMETER_ID,$row->id); 
                    //$value = 'hai';
                    //$value = $dmha_id.'-'.$PARAMETER_ID.'-'.$testing;
                  }

                  // ---------------------------- kalau input typenya
                    if(in_array($row->input_type, $exception_using_value))
                    {
                      $multi_attributes          .= ' value="'.$value.'" ';
                    }
                }
                else
                {
                  $value = '';
                }                
              
              // ------------------------------------------------------- Set Label Baru
                if(is_null($custom_label))
                {
                  //$final_custom_label = $row->nama.' '.$row->id.' '.$row->tipe_pertanyaan_id;
                  $final_custom_label = $row->nama;
                }
                elseif(!is_null($custom_label))
                {
                  $final_custom_label = $custom_label;
                }

              // ---------------------------------------------------- Set HTML DIV Open
                $isi .= '
                <div class="form-group">
                  <label class="'.$panjang_label.$label_align.' control-label">
                  '. $final_custom_label.'
                  </label>
                  <div class="col-md-'.$row->panjang_field.'">';

              // ------------------------------------------------------- Set INPUT TYPE
                // ------------------------ $row->input_type == 1 (TEXT)
                  if($row->input_type == 1)
                  {
                    $isi .= '
                    <input type="text" '.$multi_attributes.'/>';
                  }
                // ---------------------- $row->input_type == 2 (SELECT)
                  if($row->input_type == 2)
                  {
                    $isi .= '
                    <select '.$multi_attributes.'> ';

                    $isi .= '
                      <option value="">Pilih '.$row->nama.'</option>';

                    // ---------------------------- input_type_2
                      if($row->tipe_pertanyaan_id == 2)
                      {
                        $kota = wilayah_kotas::orderBy('nama','asc')->get();

                        if($tipe_data == 2)
                        {
                          $VALUE_final_helper = isi_data_details(substr($dmha_id, 0, 4),$kode_unik_khusus_value,$PARAMETER_ID_khusus_value,$sumber_data_pengisian_id_khusus_value,$berkas_data_id_khusus_value,$row->id,$helper1_khusus_value,$helper2_khusus_value,FALSE,'helper',NULL);
                        }
                        

                        foreach ($kota as $row_2) 
                        {
                          $isi .= '
                          <option value="'.$row_2->id.'" ';
                          if($row_2->id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.' '.$row_2->status.'</option>';
                        }
                      }

                    // ---------------------------- input_type_4
                      elseif($row->tipe_pertanyaan_id == 4)
                      {
                      	if($form_param_1 != 1)
                      	{	
                          if($tipe_data == 2)
                          {
    	                    	$value_last = isi_data_details(substr($dmha_id, 0, 4),$kode_unik_khusus_value,$PARAMETER_ID_khusus_value,$sumber_data_pengisian_id_khusus_value,$berkas_data_id_khusus_value,$row->id_acuan2,$helper1_khusus_value,$helper2_khusus_value,FALSE,'isi',NULL);

    	                    	$VALUE_final_helper = isi_data_details(substr($dmha_id, 0, 4),$kode_unik_khusus_value,$PARAMETER_ID_khusus_value,$sumber_data_pengisian_id_khusus_value,$berkas_data_id_khusus_value,$row->id,$helper1_khusus_value,$helper2_khusus_value,FALSE,'helper',NULL);

	                    	    $kel = wilayah_kelurahans::where('kecamatan_id','like',$value_last)->orderBy('nama','asc')->get();

                            foreach ($kel as $row_2) 
                            {
                              $isi .= '
                              <option value="'.$row_2->id.'" ';
                              if($row_2->id == $value){$isi .= ' selected ';}
                              $isi .= ' >'.$row_2->nama.' '.$row_2->status.'</option>';
                            }
                          }
	                      }
                      }

                    // --------------------------- input_type_5
                      elseif($row->tipe_pertanyaan_id == 5)
                      { 
                          $isi .= '
                            <option value="Laki-Laki"  ';
                          if('Laki-Laki' == $value){$isi .= ' selected ';}
                          $isi .= ' >Laki-Laki</option>';

                          $isi .= '
                            <option value="Perempuan"  ';
                          if('Perempuan' == $value){$isi .= ' selected ';}
                          $isi .= ' >Perempuan</option>
                          ';
                      }

                    // ---------------------------- input_type_6
                      elseif($row->tipe_pertanyaan_id == 6)
                      {
                        if($form_param_1 != 1)
                      	{	
                      		if($tipe_data == 2)
                          {
    	                    	$value_last = isi_data_details(substr($dmha_id, 0, 4),$kode_unik_khusus_value,$PARAMETER_ID_khusus_value,$sumber_data_pengisian_id_khusus_value,$berkas_data_id_khusus_value,$row->id_acuan2,$helper1_khusus_value,$helper2_khusus_value,FALSE,'isi',NULL);

    	                    	$VALUE_final_helper = isi_data_details(substr($dmha_id, 0, 4),$kode_unik_khusus_value,$PARAMETER_ID_khusus_value,$sumber_data_pengisian_id_khusus_value,$berkas_data_id_khusus_value,$row->id,$helper1_khusus_value,$helper2_khusus_value,FALSE,'helper',NULL);

    	                    	$kec = wilayah_kecamatans::where('kota_id','like',$value_last)->orderBy('nama','asc')->get();
    		                    

    	                        foreach ($kec as $row_2) 
    	                        {
    	                          $isi .= '
    	                          <option value="'.$row_2->id.'" ';
    	                          if($row_2->id == $value){$isi .= ' selected ';}
    	                          $isi .= ' >'.$row_2->nama.' '.$row_2->status.'</option>';
    	                        }
                          }
	                      }
                      }

                    // -------------------------- input_type_15
                      elseif($row->tipe_pertanyaan_id == 15)
                      { 
                          $isi .= '
                            <option value="WNA"  ';
                          if('WNA' == $value){$isi .= ' selected ';}
                          $isi .= ' >WNA</option>';

                          $isi .= '
                            <option value="WNI"  ';
                          if('WNI' == $value){$isi .= ' selected ';}
                          $isi .= ' >WNI</option>
                          ';
                      }

                    // --------------------------- input_type_17
                      elseif($row->tipe_pertanyaan_id == 17)
                      {
                        $penggunaan = penggunaan_tanahs::orderBy('nama','asc')->get();

                        foreach ($penggunaan as $row_2) 
                        {
                          $isi .= '
                          <option value="'.$row_2->nama.'" ';
                          if($row_2->nama == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }

                    // --------------------------- input_type_29
                      elseif($row->tipe_pertanyaan_id == 29)
                      {
                        $dmha_status = dmha_status::orderBy('nama','asc')->get();

                        foreach ($dmha_status as $row_2) 
                        {
                          $isi .= '
                          <option value="'.$row_2->id.'"  ';
                          if($row_2->id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }

                    // --------------------------- input_type_30
                      elseif($row->tipe_pertanyaan_id == 30)
                      {
                        $dmha = data_002914::orderBy('dmha_id','asc')->get();

                        foreach ($dmha as $row_2) 
                        {
                          $isi .= '
                          <option value="'.$row_2->dmha_id.'"  ';
                          if($row_2->dmha_id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->dmha_id.' - '.$row_2->nama.'</option>';
                        }
                      }

                    // --------------------------- input_type_32
                      elseif($row->tipe_pertanyaan_id == 32)
                      {
                          $isi .= '
                          <option value="has-sub"  ';
                          if('has-sub' == $value){$isi .= ' selected ';}
                          $isi .= ' >has-sub</option>';
                      }

                    // --------------------------- input_type_33
                      elseif($row->tipe_pertanyaan_id == 33)
                      {
                        $model = dmha_css::orderBy('nama', 'asc')->get();

                        foreach ($model as $row_2) 
                        {
                          $isi .= '
                          <option value="'.$row_2->id.'"  ';
                          if($row_2->id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_34
                      elseif($row->tipe_pertanyaan_id == 34)
                      {
                        $model = dmha_js::orderBy('nama', 'asc')->get();

                        foreach ($model as $row_2) 
                        {
                          $isi .= '
                          <option value="'.$row_2->id.'"  ';
                          if($row_2->id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_35
                      elseif($row->tipe_pertanyaan_id == 35)
                      {
                        $model = dmha_tipe_datas::orderBy('nama', 'asc')->get();

                        foreach ($model as $row_2) {
                          $isi .= '
                          <option value="'.$row_2->id.'"  ';
                          if($row_2->id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_37
                      elseif($row->tipe_pertanyaan_id == 37)
                      {
                        $model = tarot_decks::orderBy('id', 'asc')->get();

                        foreach ($model as $row_2) {
                          $isi .= '
                          <option value="'.$row_2->id.'" ';
                          if($row_2->id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_38
                      elseif($row->tipe_pertanyaan_id == 38)
                      {
                        $model = dmha_forms::orderBy('id', 'asc')->get();

                        foreach ($model as $row_2) {
                          $isi .= '
                          <option value="'.$row_2->id.'"  ';
                          if($row_2->id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_39
                      elseif($row->tipe_pertanyaan_id == 39)
                      {
                        $model = dmha_kategoris::orderBy('id', 'asc')->get();

                        foreach ($model as $row_2) {
                          $isi .= '
                          <option value="'.$row_2->id.'"  ';
                          if($row_2->id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_41
                      elseif($row->tipe_pertanyaan_id == 41)
                      { 
                          $isi .= '
                          <option value="62" ';
                          if('62' == $value){$isi .= ' selected ';}
                          $isi .= ' >UP</option>';

                          $isi .= '
                          <option value="63" ';
                          if('63' == $value){$isi .= ' selected ';}
                          $isi .= ' >DOWN</option>
                          ';
                      }
                    // --------------------------- input_type_42
                      elseif($row->tipe_pertanyaan_id == 42)
                      { 
                        $model = data_002914::whereNull('parent_id')->get();

                        foreach ($model as $row_2) 
                        {
                          $isi .= '
                          <option value="'.$row_2->dmha_id.'" ';
                          if($row_2->dmha_id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_45
                      elseif($row->tipe_pertanyaan_id == 45)
                      { 
                          $isi .= '
                            <option value="1"  ';
                          if('1' == $value){$isi .= ' selected ';}
                          $isi .= ' >Income</option>
                            <option value="2"  ';
                          if('2' == $value){$isi .= ' selected ';}
                          $isi .= ' >Expense</option>
                          ';
                      }
                    // --------------------------- input_type_46
                      elseif($row->tipe_pertanyaan_id == 46)
                      { 
                        $model = finance_categories::orderBy('nama','asc')->get();

                        foreach ($model as $row_2) 
                        {
                          $isi .= '
                          <option value="'.$row_2->id.'"  ';
                          if($row_2->id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_47
                      elseif($row->tipe_pertanyaan_id == 47)
                      { 
                        $model = data_002914::where('parent_id','like','07')->get();

                        foreach ($model as $row_2) 
                        {
                          $isi .= '
                          <option value="'.$row_2->dmha_id.'"  ';
                          if($row_2->dmha_id == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_48
                      elseif($row->tipe_pertanyaan_id == 48)
                      { 
                        $model = bg_colors::all();

                        foreach ($model as $row_2) 
                        {
                          $isi .= '
                          <option class="'.$row_2->nama.'" value="'.$row_2->id.'"  ';
                          if($row_2->nama == $value){$isi .= ' selected ';}
                          $isi .= ' >'.$row_2->nama.'</option>';
                        }
                      }
                    // --------------------------- input_type_49
                      elseif($row->tipe_pertanyaan_id == 49)
                      { 
                          $isi .= '
                            <option value="dmha_id"  ';
                          if('dmha_id' == $value){$isi .= ' selected ';}
                          $isi .= ' >dmha_id</option>';

                          $isi .= '
                            <option value="parent_id"  ';
                          if('parent_id' == $value){$isi .= ' selected ';}
                          $isi .= ' >parent_id</option>';

                          $isi .= '
                            <option value="grand_parent_id"  ';
                          if('grand_parent_id' == $value){$isi .= ' selected ';}
                          $isi .= ' >grand_parent_id</option>';
                      }
                    // --------------------------- input_type_54
                      elseif($row->tipe_pertanyaan_id == 54)
                      { 
                          $isi .= '
                            <option value="Desa"  ';
                          if('Desa' == $value){$isi .= ' selected ';}
                          $isi .= ' >Desa</option>';

                          $isi .= '
                            <option value="Kelurahan"  ';
                          if('Kelurahan' == $value){$isi .= ' selected ';}
                          $isi .= ' >Kelurahan</option>
                          ';
                      }
                    

                    $isi .= '
                    </select>';
                  }
                // --------------------- $row->input_type == 3 (TEXAREA)
                  elseif($row->input_type == 3)
                  {
                    $isi .= '
                    <textarea 
                      '.$multi_attributes.'
                      rows="5">'.$value.'</textarea>';
                  }            
                // ------------------- $row->input_type == 4 (ADD-ON m2)
                  elseif($row->input_type == 4)
                  {
                    //Luas
                    $isi .= '
                    <div class="input-group">
                      <input type="text" '.$multi_attributes.'/>
                      <span class="input-group-addon">m&sup2;</span>
                    </div>
                    ';
                  }
                // ------------------- $row->input_type == 5 (ADD-ON Rp)
                  elseif($row->input_type == 5)
                  {
                    $isi .= '
                    <div class="input-group">
                      <span class="input-group-addon">Rp.</span>
                      <input type="text" '.$multi_attributes.'/>
                    </div>
                    ';
                  }
                // ----------- $row->input_type == 6 (Radio Icon Inline)
                  elseif($row->input_type == 6)
                  {
                    // --------------------------- tipe_pertanyaan_id_31
                      if($row->tipe_pertanyaan_id == 31)
                      { 
                        $icon_ios = font_awesome::orderBy('nama', 'asc')->get();

                        $isi .= '
                        <div class="radio-inline">
                            <label>
                                <input type="radio" 
                                '.$multi_attributes.'
                                value="" />
                                NULL
                            </label>
                        </div>
                        ';

                        foreach ($icon_ios as $row_2) {
                        $isi .= '
                        <div class="radio-inline">
                            <label>
                                <input type="radio" 
                                '.$multi_attributes.'
                                value="'.$row_2->id.'" ';

                                if($row_2->id == $value){$isi .= ' checked ';}

                                $isi .= ' />
                                <i class="'.$row_2->nama.' fa-2x"></i>
                            </label>
                        </div>
                        ';
                        }
                      }
                  }
                // ------------------- $row->input_type == 7 (check box)
                  elseif($row->input_type == 7)
                  {
                    // ------------------------- tipe_pertanyaan_id_44
                      if($row->tipe_pertanyaan_id == 44)
                      {
                        $sumber_data_pengisians = sumber_data_pengisians::whereIn('id', [1, 3, 4,5,6,7,10,33])
                        		->orderBy('id','ASC')->get();

                        $pertanyaans = pertanyaans::orderBy('id','ASC')->get();


                        //Pilihan dmha
                        foreach ($sumber_data_pengisians as $sdp) {
                          $isi .= '
                            <div class="checkbox">
                              <label><h1>';
                                $isi .= $sdp->nama;
                                $isi .= '</h1>
                              </label>
                            </div>
                          ';
                          foreach ($pertanyaans as $prtn) {
                            if($sdp->id == $prtn->sumber_data_pengisian_id)
                            {
                              $isi .= '
                                <div class="checkbox">
                                    <label>';


                                      $isi .= '
                                      <input type="checkbox" 
                                      '.$multi_attributes.'
                                      value="'.$prtn->id.'" ';

                                      //$isi .= isi_form_new($dmha_id,NULL,$prtn->id);

                                      $isi .= '
                                       />
                                      '.$prtn->nama.' - '.$dmha_id.'-'.$PARAMETER_ID.'-';

                                      $isi .= '
                                    </label>
                                </div>
                              ';
                            }
                          }
                        }
                      }
                    // ------------------------- tipe_pertanyaan_id_53
                      elseif($row->tipe_pertanyaan_id == 53)
                      {
                        $dmha_id = data_002914::orderBy('dmha_id')->get();

                        //Pilihan dmha
                          foreach ($dmha_id as $dmhid) 
                          {
                            $isi .= '
                              <div class="checkbox">
                                  <label>';

                                    $isi .= '
                                    <input type="checkbox" 
                                    '.$multi_attributes.'
                                    value="'.$dmhid->dmha_id.'" ';

                                    //$isi .= isi_form_checkboxes_new($dmha_id,NULL,$dmhid->id);
                                    //$isi .= isi_form_checkboxes_new($dmha_id,$PARAMETER_ID,$row->pertanyaan_id,$dmhid->id);

                                    $isi .= '
                                     />
                                    '.$dmhid->dmha_id.' - '.$dmhid->nama.' - '.$PARAMETER_ID;

                                    $isi .= '
                                  </label>
                              </div>
                            ';                            
                          }
                        
                      }
                  }
                // --------------------- $row->input_type == 8 (TEXAREA)
                  elseif($row->input_type == 8)
                  {
                    $isi .= '
                    <textarea 
                      '.$multi_attributes.'
                      rows="10">'.$value.'</textarea>';
                  }
                // ------------------ $row->input_type == 9 (Radio Icon)
                  elseif($row->input_type == 9)
                  {
                    // --------------------------- tipe_pertanyaan_id_55
                      if($row->tipe_pertanyaan_id == 55)
                      { 
                        $isi .= '
                        <div class="radio">
                            <label>
                                <input type="radio" 
                                '.$multi_attributes.'
                                value="1" />
                                Ya
                            </label>
                        </div>
                        ';

                        $isi .= '
                        <div class="radio">
                            <label>
                                <input type="radio" 
                                '.$multi_attributes.'
                                value="0" />
                                Tidak
                            </label>
                        </div>
                        ';

                        
                      }
                  }
                // -------------------- $row->input_type == 10 (WYSIWYG)
                  elseif($row->input_type == 10)
                  {
                    $isi .= '
                    <textarea class="textarea form-control" id="wysihtml5" placeholder="'.$value.'"  '.$set_name_form.' rows="20"></textarea>';
                  }

                // --------------------------------------- input_type_20
                  elseif($row->tipe_pertanyaan_id == 20)
                  {
                  }

                // --------------------------------------- input_type_22
                  elseif($row->tipe_pertanyaan_id == 22)
                  {
                  }

                // --------------------------------------- input_type_24
                  elseif($row->tipe_pertanyaan_id == 24)
                  {
                  }

                // --------------------------------------- input_type_26
                  elseif($row->tipe_pertanyaan_id == 26)
                  {
                  }

                // --------------------------------------- input_type_27
                  elseif($row->tipe_pertanyaan_id == 27)
                  {
                  }

                // --------------------------------------- input_type_28
                  elseif($row->tipe_pertanyaan_id == 28)
                  {
                  }
                
                
                  
                // --------------------------------------- input_type_40
                  elseif($row->tipe_pertanyaan_id == 40)
                  {
                  	$isi .= 'hai';
                    $dmha_05 = data_002914::where([['dmha_id','like','05%'],['dmha_id','!=','05']])->orderBy('dmha_id','Asc')->get();
                    //Pilihan dmha
                    foreach ($dmha_05 as $row_2) {
                      if(strlen($row_2->dmha_id) <= 8)
                      {
                      $isi .= '
                      <div class="checkbox">
                          <label>';


                          if(strlen($row_2->dmha_id) == 8)
                          {
                            $isi .= '
                            <input type="checkbox" 
                            '.$name_form.' 
                            '.$required.' 
                            value="'.$row_2->dmha_id.'" ';

                            if($tipe_data == 2  || $tipe_data == 3)
                            {
                              $isi .= isi_form($dmha_id,$row_2->dmha_id,NULL);
                            }

                            $isi .= '
                             />
                            '.$row_2->nama;
                          }
                          elseif(strlen($row_2->dmha_id) <= 7)
                          {
                            $isi .= $row_2->nama;
                          }

                            $isi .= '
                          </label>
                      </div>
                      ';
                      }
                    }
                  }


                

              // -------------------------------------------- Field Pertanyaan & Helper
                $hidden_class = ' hidden ';

                if($form_param_1 == 2)
                {
                  //---------------------------- Pertanyaan_id
                    $isi .= '
                    <input 
                    type="text" 
                    class="form-control '.$hidden_class.'" 
                    '.$pertanyaans_name.'
                    value="'.$row->id.'"
                    />
                    ';

                  //----------------------------------- helper
                    // ---------------- set value helper
                      // if(!is_null($value_helper))
                      // {
                      //   $final_value_helper = 'value="'.$value_helper.'" ';
                      // }
                      // elseif(is_null($value_helper))
                      // {
                      //   $final_value_helper = '';
                      // }

                    $final_value_helper = ' value="'.$VALUE_final_helper.'" ';

                    // --------------------- show helper
                      $isi .= '
                      <input 
                      id="helper_'.$value_id.'"
                      type="text" 
                      class="form-control '.$hidden_class.'"
                      '.$helpers_name.' 
                      '.$final_value_helper.'
                      />
                      ';
                }

              // --------------------------------------------------- Set HTML DIV Close
                $isi .= '
                  </div>
                </div>
                ';
            }
          }
        // ---------------------------------------------------------------------- kalau datanya TIDAK ADA
          else
          {
            $isi .= 'Please Make Model in Ui Input Type Helper '.$dmha_id;
          }


        $words = $isi;
        return $words;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  }

  function input_type_auto($sumber_data_pengisian_id)
  { 
    // ----------------------------------------------------------------------------------------------------- INITIALIZE
      $sdp_model = sumber_data_pengisians::where('id','like',$sumber_data_pengisian_id)->first();

      $sdp_nama           = $sdp_model->nama;
      $sdp_pertanyaan_id  = $sdp_model->acuan_pertanyaan_id;
      $href_link          = str_replace(' ', '_', $sdp_model->nama);

      $pertanyaan_model   = pertanyaans::where('id','like',$sdp_pertanyaan_id)->first();

      $sdp_pertanyaan_id        = $pertanyaan_model->acuan_pertanyaan_id;
      $sdp_tipe_pertanyaan_id   = $pertanyaan_model->tipe_pertanyaan_id;
      $href_link2               = str_replace(' ', '_', $pertanyaan_model->nama);

      $isi = '';
      $isi .= '
      <div class="row margin-bottom-20">
        <div class="col-md-6 col-md-offset-3">
          <div class="input-group">
            <input type="text" id="'.$href_link.'_'.$href_link2.'" class="form-control " 
              placeholder="Tambah Data '.$sdp_nama.'? Masukkan Nomor '.$sdp_nama.' terlebih dahulu" />

            <span class="input-group-addon">
              <i class="fa fa-search"></i>
            </span>
          </div>
        </div>
      </div>


      <div class="table-responsive"  id="show_me_the_auto_table_'.$href_link.'">
      </div>
                  ';

      $words = $isi;
      return $words;
  }


  function unlimited_form_helper1($parent_id,$name,$value)
  { 
    if($value == 'NUL')
    {
      $value = '';
    }
    
    $isi = '';
    $isi .= '
      <div class="form-group">
              <label class=" col-md-3  text-left  control-label">
                Sebagai
              </label>
              <div class="col-md-4">
                <select class="  form-control"  name="'.$name.'_helper1">';

                $pengecualian_sdp_kuasa = pengaturan_02::where('parent_id','like',$parent_id)->value('optimisasi_data_kuasa');
                $pengecualian_sdp_lurah = pengaturan_02::where('parent_id','like',$parent_id)->value('optimisasi_data_lurah');
                $pengecualian_sdp_saksi = pengaturan_02::where('parent_id','like',$parent_id)->value('optimisasi_data_saksi');

                $final_cari_sdp = ' id NOT IN (0';

                if(!is_null($pengecualian_sdp_kuasa) && $pengecualian_sdp_kuasa == 1)
                {
                  $final_cari_sdp .= ',2';
                }
                if(!is_null($pengecualian_sdp_lurah) && $pengecualian_sdp_lurah == 1)
                {
                  $final_cari_sdp .= ',3';
                }
                if(!is_null($pengecualian_sdp_saksi) && $pengecualian_sdp_saksi == 1)
                {
                  $final_cari_sdp .= ',4';
                }
                $final_cari_sdp .= ')';


                $temp_data = ktps::WhereRaw($final_cari_sdp)->get();

                $isi .= '<option value="">Pilih Sebagai</option>';

                foreach ($temp_data as $row) {
                  $isi .= '<option value="'.$row->id.'" ';
                    if($value == $row->id){$isi .= ' selected ';}
                  $isi .= '>'.$row->nama.'</option>';
                }
                    
                  $isi .= '
                </select>
                  
              </div>
            </div>
      ';

    $words = $isi;
    return $words;
  }

  function unlimited_form_helper2($name,$value)
  { 
    if($value == 'NUL')
    {
      $value = '';
    }
    
    return '
            <div class="form-group">
              <label class=" col-md-3  text-left  control-label">
              Ke
              </label>
              <div class="col-md-2">
                <input type="text"   class="  form-control "  name="'.$name.'_helper2" value="'.$value.'" />  
                <input type="text"   class="  form-control hidden"  name="'.$name.'_helper3" value="" />   
                <input type="text"   class="  form-control hidden"  name="'.$name.'_helper4" value="" />                                 
              </div>
            </div>
      ';
  }

  function unlimited_form_helper1234($name,$value)
  { 
    if($value == 'NUL')
    {
      $value = '';
    }
    
    return '
      <div class="form-group hidden">
              <label class=" col-md-3  text-left  control-label ">
              </label>
              <div class="col-md-3">
                <input type="text" class="  form-control"  name="'.$name.'_helper1"  value="'.$value.'"/>
                <input type="text" class="  form-control"  name="'.$name.'_helper2"  value="'.$value.'"/>
                <input type="text" class="  form-control"  name="'.$name.'_helper3"  value="'.$value.'"/>
                <input type="text" class="  form-control"  name="'.$name.'_helper4"  value="'.$value.'"/>
              </div>
            </div>
      ';
  }

  function unlimited_form_helper1_sdp6($name,$value)
  { 
    if($value == 'NUL')
    {
      $value = '';
    }
    
    return '
      <div class="form-group">
              <label class=" col-md-3  text-left  control-label ">
                Tanggal Peralihan
              </label>
              <div class="col-md-3">
                <input type="text" id="tanggal_peralihan"  class="  form-control datepicker-autoClose"  name="'.$name.'_helper1"  value="'.$value.'"/>
              </div>
            </div>
      ';
  }

  function unlimited_form_helper2_sdp6($name,$value)
  { 
    if($value == 'NUL')
    {
      $value = '';
    }
    
    return '
      <div class="form-group hidden">
              <label class=" col-md-3  text-left  control-label ">
                Tanggal Peralihan
              </label>
              <div class="col-md-4">
                <input type="text" id="konversi_tanggal_peralihan"  class="  form-control "  name="'.$name.'_helper2" value="'.$value.'"/>
              </div>
            </div>
      ';
  }

  function unlimited_form_helper3_sdp6($name,$value)
  { 
    if($value == 'NUL')
    {
      $value = '';
    }
    
    return '
      <div class="form-group">
              <label class=" col-md-3  text-left  control-label ">
                Dasar Perolehan
              </label>
              <div class="col-md-4">
                <input type="text"   class="  form-control "  name="'.$name.'_helper3" value="'.$value.'" />
              </div>
            </div>
      ';
  }

  function unlimited_form_helper4_sdp6($name,$value)
  { 
    if($value == 'NUL')
    {
      $value = '';
    }
    
    return '
      <div class="form-group hidden">
              <label class=" col-md-3  text-left  control-label ">
                Desa
              </label>
              <div class="col-md-4">
                <input type="text"   class="  form-control "  name="'.$name.'_helper4" value="'.$value.'" />
              </div>
            </div>
      ';
  }

  function unlimited_form_helper1_03($name,$value)
  { 
    if($value == 'NUL')
    {
      $value = '';
    }
    
    $isi = '';
    $isi .= '
      <div class="form-group">
              <label class=" col-md-3  text-left  control-label">
                Sebagai
              </label>
              <div class="col-md-4">
                <label class="  text-left  control-label">
                  '.read_row_all_database('ktps',$value,'nama').'
                </label>
                <input type="text" class="hidden  form-control "  name="'.$name.'_helper2" value="'.$value.'"/>
                 ';                    
                  $isi .= '
              </div>
            </div>
      ';

    $words = $isi;
    return $words;
  }
