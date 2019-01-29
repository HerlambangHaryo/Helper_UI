<?php
	
  use App\wilayah_kecamatans;
  use App\wilayah_kelurahans;
  use App\wilayah_kotas;

  use App\data_2102;
  use App\data_2105;
  use App\data_2113;
  use App\data_002120; // multi hak akses
  use App\list_002120; // multi hak akses
  use App\data_2121;
  use App\data_2124; // agama
  use App\data_2125; // pihak bersangkutan
  use App\data_2126; // penggunaan tanah
  use App\data_2127; // status tanah
  use App\data_2128; // pekerjaan
  use App\data_2129; // jenis kelamin
  use App\data_2130; // status perkawinan
  use App\data_2131; // kewarganegaran
  use App\data_2132; // Perolehan
  use App\data_2133; // Alas Hak

    use App\data_002901; // UI
    use App\data_002902; // Content
    use App\data_002903; // Custom Css Js
    use App\data_002904; // Forms
    use App\data_002905; // Categories
    use App\data_002906; // Status
    use App\data_002907; // Type
    use App\data_002908; // Data Type
    use App\data_002909; // Pertanyaan
    use App\data_002910; // Pertanyaan Type
    use App\data_002911; // Sumber Data Pengisian
    use App\data_002912; // Font Awesome
    use App\data_002913; // Css Js
    use App\data_002914; // DMHA
    use App\data_002915; // Input Type
    use App\data_002916; // Appmode
    use App\list_002916; // Appmode
    use App\data_002917; // Sub Features



	function generate_form_group($LABEL,$PANJANG_FIELD,$INPUT_TYPE,$CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$FORM,$SUMBER_DATA_PENGISIAN_ID){
        // ------------------------------------------------------------------------- INITIALIZE
        	$isi = '';
        // ------------------------------------------------------------------------- ACTION
    		$isi .= '<div class="form-group row">';
    			$isi .= generate_label_input($LABEL,$ID);

            $isi .= '<div class="col-md-'.$PANJANG_FIELD.'">';
            $isi .= generate_div_input($INPUT_TYPE,$CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM,$SUMBER_DATA_PENGISIAN_ID);
            $isi .= '</div>';

    		$isi .= '</div>';
        // ------------------------------------------------------------------------- SEND
    		$words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_label_input($LABEL,$ID){
        // ------------------------------------------------------------------------- INITIALIZE
        	$isi = '';
        // ------------------------------------------------------------------------- ACTION
    		$isi .= '<label class="col-md-3 col-form-label">'.$LABEL.'-'.$ID.'</label>';
        // ------------------------------------------------------------------------- SEND
    		$words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_div_input($INPUT_TYPE,$CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM,$SUMBER_DATA_PENGISIAN_ID){
        // ------------------------------------------------------------------------- INITIALIZE
        	$isi = '';
            if($FORM == 2)
            { 
                $NAME = 'isi[]'; 
            }
            elseif($FORM == 3)
            {           
                $NAME = 'isi_'.$SUMBER_DATA_PENGISIAN_ID.'[]'; 
            }
        // ------------------------------------------------------------------------- ACTION
            if($INPUT_TYPE == '1'){ // --------------------------------------------- TEXT
                $isi .= generate_new_input_type_1($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '2'){ // ---------------------------------------- SELECT
            	$isi .= generate_new_input_type_2($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '3'){ // ---------------------------------------- TEXT AREA
            	$isi .= generate_new_input_type_3($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '4'){ // ---------------------------------------- LUAS
                $isi .= generate_new_input_type_4($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '5'){ // ---------------------------------------- RUPIAH
                $isi .= generate_new_input_type_5($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '6'){ // --------------------------------------- RADIO INLINE
                $isi .= generate_new_input_type_6($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '7'){ // ---------------------------------------- RUPIAH
                $isi .= generate_new_input_type_7($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '8'){ // ---------------------------------------- RUPIAH
                $isi .= generate_new_input_type_8($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '9'){ // ---------------------------------------- RUPIAH
                $isi .= generate_new_input_type_9($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '14'){ // --------------------------------------- RADIO INLINE
            	$isi .= generate_new_input_type_14($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '15'){ // --------------------------------------- RADIO INLINE
                $isi .= generate_new_input_type_15($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }elseif($INPUT_TYPE == '16'){ // --------------------------------------- RADIO INLINE
                $isi .= generate_new_input_type_16($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }else{ // -------------------------------------------------------------- ELSE
                $isi .= ' 0.'.$INPUT_TYPE.'<br/>1.'.$CLASS_PERTANYAANS.'<br/>2.'.$NAME.'<br/>3.'.$ID.'<br/>4.'.$VALUE.'<br/>5.'.$TIPE_DATA.'<br/>6.'.$TIPE_PERTANYAAN_ID.'<br/>7.'.$LABEL.'<br/>8.'.$FORM;
            }

            // FORM == 2
            if($FORM == 2)
            {
                $isi .= generate_new_input_type_1(' none ','sumber_data_pengisian_id[]',$ID,$SUMBER_DATA_PENGISIAN_ID,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
                $isi .= generate_new_input_type_1(' none ','pertanyaan_id[]',$ID,$ID,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
                $isi .= generate_new_input_type_1(' none ','helper[]',$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }            
            elseif($FORM == 3)
            {
                $isi .= generate_new_input_type_1(' none ','pertanyaan_id_'.$SUMBER_DATA_PENGISIAN_ID.'[]',$ID,$ID,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
                $isi .= generate_new_input_type_1(' none ','helper_'.$SUMBER_DATA_PENGISIAN_ID.'[]',$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
                
            }          
            
            if($TIPE_DATA == 4)
            {
                $isi .= generate_new_input_type_1(' none ',$NAME,$ID,$SUMBER_DATA_PENGISIAN_ID,'3',$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            }
        // ------------------------------------------------------------------------- SEND
    		$words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_attr_class_input_type($CLASS_PERTANYAANS){
        // ------------------------------------------------------------------------- INITIALIZE
        	$isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= ' class="form-control '.$CLASS_PERTANYAANS.' "';
        // ------------------------------------------------------------------------- SEND
    		$words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_attr_name_input_type($NAME){
        // ------------------------------------------------------------------------- INITIALIZE
        	$isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= ' name="'.$NAME.'" ';
        // ------------------------------------------------------------------------- SEND
    		$words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_attr_id_input_type($ID){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= ' id="input_'.$ID.'" ';
        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_attr_value_input_type($VALUE){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= ' value="'.$VALUE.'" ';
        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }   

    function generate_attr_value_check_input_type($VALUE,$INPUT_TYPE_VALUE){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
            $temp_VALUE = explode('#', $VALUE);
            $dmha_id        = $temp_VALUE[0];
            $ID             = $temp_VALUE[1];
        // ------------------------------------------------------------------------- ACTION
            if($dmha_id == '00212005'){ // -------------------------- multi access system
                $IS_TRUE = list_002120::check_value($ID,$INPUT_TYPE_VALUE);
            }
            elseif($dmha_id == '00291605'){ // -------------------------- App Mode
                $IS_TRUE = list_002916::check_value($ID,$INPUT_TYPE_VALUE);
            }

            //if(count($IS_TRUE) > 0) php 7.1.22
                if(!is_null($IS_TRUE)){
                    $isi = ' checked ';
                }
        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    } 

    function generate_attr_value_selected_input_type($VALUE,$INPUT_TYPE_VALUE){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            if($VALUE == $INPUT_TYPE_VALUE)
            {
                $isi .= ' selected ';
            }
        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    } 

    function generate_attr_placeholder_input_type($TIPE_PERTANYAAN_ID){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            if($TIPE_PERTANYAAN_ID == '3'){
                $isi .= ' placeholder="dd-mm-yyyy" ';
            }

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_attr_disabled_input_type($TIPE_DATA){
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            if($TIPE_DATA == '4'){
                $isi .= ' disabled ';
            }
        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_attr_all_in_one($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){
        // ------------------------------------------------------------------------- INITIALIZE
        	$isi = '';
        // ------------------------------------------------------------------------- ACTION            
            $isi .= generate_attr_class_input_type($CLASS_PERTANYAANS);
            $isi .= generate_attr_name_input_type($NAME,$FORM);
            $isi .= generate_attr_id_input_type($ID);
            $isi .= generate_attr_value_input_type($VALUE);
            $isi .= generate_attr_placeholder_input_type($TIPE_PERTANYAAN_ID);
            $isi .= generate_attr_disabled_input_type($TIPE_DATA);
        // ------------------------------------------------------------------------- SEND
    		$words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_1($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //---------------- input type 1
        // ------------------------------------------------------------------------- INITIALIZE
        	$isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= '<input type="text" ';
            $isi .= generate_attr_all_in_one($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            $isi .= ' />';         
        // ------------------------------------------------------------------------- SEND
    		$words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_2($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //---------------- input type 2
        // ------------------------------------------------------------------------- INITIALIZE
            $isi            = '';
            $isi_model      = NULL;
            $value_status   = NULL;

        // ------------------------------------------------------------------------- ACTION
            $isi .= '<select ';
            //$isi .= generate_attr_all_in_one($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
                $isi .= generate_attr_class_input_type($CLASS_PERTANYAANS);
                $isi .= generate_attr_name_input_type($NAME,$FORM);
                $isi .= generate_attr_disabled_input_type($TIPE_DATA);

            $isi .= ' > ';
            $isi .= '<option value="" >Pilih '.$LABEL.'</option>';   

            if($TIPE_PERTANYAAN_ID == 2) // --------------------------------------- Kabupaten Kota
            {
                $isi_model = wilayah_kotas::select_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 4) // ---------------------------------- Desa Kelurahan
            {  
                //$isi .= '<option>'.$TIPE_PERTANYAAN_ID.'</option>';
            }
            elseif($TIPE_PERTANYAAN_ID == 5) // --------------------------------- Jenis Kelamin           
            {   
                $isi_model = data_2129::select_order_by_nama_asc();       
                $value_status = 'as_name';         
            }
            elseif($TIPE_PERTANYAAN_ID == 6) // ---------------------------------- Kecamatan
            {   
                //$isi .= '<option>'.$TIPE_PERTANYAAN_ID.'</option>';
            }
            elseif($TIPE_PERTANYAAN_ID == 8) // --------------------------------- Pekerjaan           
            {   
                $isi_model = data_2128::select_order_by_nama_asc();    
                $value_status = 'as_name';            
            }
            elseif($TIPE_PERTANYAAN_ID == 11) // --------------------------------- Dasar Peralihan           
            {    
                $isi_model = data_2132::select_order_by_nama_asc();
                $value_status = 'as_name';
            }
            elseif($TIPE_PERTANYAAN_ID == 14) // --------------------------------- Alas HAk           
            {    
                $isi_model = data_2133::select_order_by_nama_asc();
                $value_status = 'as_name';
            }
            elseif($TIPE_PERTANYAAN_ID == 15) // --------------------------------- Kewarganegaraab            
            {    
                $isi_model = data_2131::select_order_by_nama_asc();
                $value_status = 'as_name';
            }
            elseif($TIPE_PERTANYAAN_ID == 16) // --------------------------------- Status Tanah            
            {    
                $isi_model = data_2127::select_order_by_nama_asc();
                $value_status = 'as_name';
            }
            elseif($TIPE_PERTANYAAN_ID == 17) // --------------------------------- Penggunaan            
            {    
                $isi_model = data_2126::select_order_by_nama_asc();
                $value_status = 'as_name';
            }
            elseif($TIPE_PERTANYAAN_ID == 18) // --------------------------------- Agama                
            {    
                $isi_model = data_2124::select_order_by_nama_asc();
                $value_status = 'as_name';
            }
            elseif($TIPE_PERTANYAAN_ID == 21) // --------------------------------- Status Perkawinan                
            {    
                $isi_model = data_2130::select_order_by_nama_asc();
                $value_status = 'as_name';
            }
            elseif($TIPE_PERTANYAAN_ID == 29) // --------------------------------- Status                
            {    
                $isi_model = data_002906::select_order_by_nama_asc();                
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 30) // --------------------------------- DMHA                
            {    
                $isi_model = data_002914::what_is_my_has_sub();                
                $value_status = 'as_dmha_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 35) // --------------------------------- DMHA                
            {    
                $isi_model = data_002908::select_order_by_nama_asc();                
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 39) // --------------------------------- Kategori                
            {    
                $isi_model = data_002905::select_order_by_nama_asc();                
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 44) // --------------------------------- Pertanyaan                
            {    
                $isi_model = data_002909::select_order_by_nama_asc();                
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 61) // --------------------------------- Buildings
            {    
                $isi_model = data_2102::select_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 62) // --------------------------------- floor
            {    
                $isi_model = data_2105::read_data_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 63) // --------------------------------- location
            {    
                $isi_model = data_2113::read_data_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 64) // --------------------------------- work categories
            {   
                $isi_model = data_2121::read_data_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 66) // --------------------------------- pihak bersangkutan                
            {
                $isi_model = data_2125::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 67) // --------------------------------- Pilihan Pertanyaan type               
            {
                $isi_model = data_002910::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 68) // --------------------------------- Pilihan Input type               
            {
                $isi_model = data_002915::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 69) // --------------------------------- Pilihan Sumber Data Pengisian               
            {
                $isi_model = data_002911::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 71) // --------------------------------- Pilihan UI              
            {
                $isi_model = data_002901::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 72) // --------------------------------- Pilihan Custom Css Js             
            {
                $isi_model = data_002903::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 73) // --------------------------------- Pilihan Data Type              
            {
                $isi_model = data_002908::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 74) // --------------------------------- Pilihan Form              
            {
                $isi_model = data_002904::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 75) // --------------------------------- Pilihan Type               
            {
                $isi_model = data_002907::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 76) // --------------------------------- Pilihan Categories              
            {
                $isi_model = data_002905::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 78) // --------------------------------- Pilihan Css             
            {
                $isi_model = data_002913::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 79) // --------------------------------- Pilihan Content              
            {
                $isi_model = data_002902::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 80) // --------------------------------- Pilihan Sub Features              
            {
                $isi_model = data_002917::select_order_by_nama_asc();
                $value_status = 'as_id';
            }
            elseif($TIPE_PERTANYAAN_ID == 83) // --------------------------------- Pilihan Multi Access Systems's Lists For User            
            {
                $isi_model = data_002120::select_order_by_nama_asc();
                $value_status = 'as_id';
            }


            if(!is_null($isi_model))
            {
                foreach ($isi_model as $row) {                                    
                    $isi .= '<option ';

                    if($value_status == 'as_id')
                    {
                        $isi .= ' value="'.$row->id.'" ';
                    }
                    elseif($value_status == 'as_name')
                    {
                        $isi .= ' value="'.$row->name.'" ';
                    }
                    elseif($value_status == 'as_dmha_id')
                    {
                        $isi .= ' value="'.$row->dmha_id.'" ';
                    }
                    else
                    {
                        $isi .= ' value="'.$row->id.'" ';
                    }


                    if($TIPE_DATA != 1)
                    {
                        if($TIPE_PERTANYAAN_ID == 30)
                        {                            
                            $isi .= generate_attr_value_selected_input_type($VALUE,$row->dmha_id);
                        }
                        else
                        {
                            //$isi .= generate_attr_value_selected_input_type($VALUE.'#'.$row->id);
                            $isi .= generate_attr_value_selected_input_type($VALUE,$row->id);
                        }
                    }

                    //$isi .= ' >'.$row->nama;
                    $isi .= ' >'.$row->nama.'-'.$VALUE.'#'.$row->id;

                    if($TIPE_PERTANYAAN_ID == 62)
                    {                        
                        $isi .= ', '.data_2102::read_data_by_id($row->data_2102_id,'nama');
                    }
                    elseif($TIPE_PERTANYAAN_ID == 63)
                    {                        
                        $isi .= ', '.data_2105::read_data_by_id($row->data_2105_id,'nama');
                        $isi .= ', '.data_2102::read_data_by_id(data_2105::read_data_by_id($row->data_2105_id,'data_2102_id'),'nama');
                    }

                    $isi .= '</option>';
                }
            }
            else
            {
                $isi .= '<option>'.$TIPE_PERTANYAAN_ID.'</option>';
            }

            $isi .= '</select>';

            

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_3($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //---------------- input type 3
        // ------------------------------------------------------------------------- INITIALIZE
        	$isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= '<textarea ';          
            $isi .= generate_attr_class_input_type($CLASS_PERTANYAANS);
            $isi .= generate_attr_name_input_type($NAME,$FORM);
            $isi .= generate_attr_id_input_type($ID);
            $isi .= ' rows="3">';
            $isi .= $VALUE;
            $isi .= '</textarea>';

        // ------------------------------------------------------------------------- SEND
    		$words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_4($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //---------------- input type 1
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= '<div class="input-group">';
            $isi .= '<input type="text" ';
            $isi .= generate_attr_all_in_one($CLASS_PERTANYAANS.' masked-tes',$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            $isi .= ' />';
            $isi .= '<span class="input-group-addon">m&sup2;</span>';
            $isi .= '</div>';

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_5($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //---------------- input type 1
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= '<div class="input-group">';
            $isi .= '<span class="input-group-addon">Rp.</span>';
            $isi .= '<input type="text" ';
            $isi .= generate_attr_all_in_one($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            $isi .= ' />';
            $isi .= '</div>';

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_6($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //--------------- input type 14
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
            $isi_model = NULL;
        // ------------------------------------------------------------------------- ACTION
            if($TIPE_PERTANYAAN_ID == 5) //----------------------------------------------- jenis Kelamin
            {
                $isi_model = data_2129::select_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 15) //----------------------------------------------- kewarganegaran
            {
                $isi_model = data_2131::select_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 16) //----------------------------------------------- status Tanah
            {
                $isi_model = data_2127::select_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 17) //----------------------------------------------- Penggunaan Tanah
            {
                $isi_model = data_2126::select_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 21) //----------------------------------------------- Status Perkawinan
            {
                $isi_model = data_2130::select_order_by_nama_asc();
            }
            elseif($TIPE_PERTANYAAN_ID == 55) //----------------------------------------------- Ya Tidak
            {
                $isi .= '
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="'.$NAME.'" value="0" checked />
                        <label class="form-check-label">No</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="'.$NAME.'" value="1" />
                        <label class="form-check-label">Yes</label>
                    </div>
                ';
            }


            if(!is_null($isi_model))
            {
                foreach ($isi_model as $row) 
                {  
                    $isi .= '            
                        <div class="form-check">
                            <input class="form-check-input" type="radio" ';                        
                                $isi .= generate_attr_name_input_type($NAME,$FORM);
                                $isi .= generate_attr_id_input_type($ID);
                    $isi .= ' value="'.$row->nama.'"  />
                            <label class="form-check-label" for="defaultRadio">'.$row->nama.'</label>
                        </div>
                    ';
                }
            }


        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }


    function generate_new_input_type_7($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //---------------- input type 7
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
            $last_dmha_id = '';
        // ------------------------------------------------------------------------- ACTION
            if($TIPE_PERTANYAAN_ID == 60 || $TIPE_PERTANYAAN_ID == 82){ // --------------------------------------- DMHA
                $isi_model = data_002914::read_all();
                foreach ($isi_model as $row) {
                    $isi .= '<div class="form-check">';
                    $isi .= '<input class="form-check-input" type="checkbox" 
                            value="'.$row->dmha_id.'" 
                            name="'.$NAME.'[]" ';
                    //$isi .= generate_attr_name_input_type($NAME,$FORM);
                    if($TIPE_DATA != 1){
                        //$isi .= generate_attr_value_check_input_type($VALUE.'#'.$row->dmha_id);
                        $isi .= generate_attr_value_check_input_type($VALUE,$row->dmha_id);
                    }

                    $isi .= generate_attr_disabled_input_type($TIPE_DATA);
                    $isi .= ' />';
                    $isi .= '<label class="form-check-label"  for="defaultCheckbox">';
                    if(is_null($row->parent_id)){
                        $isi .= $row->nama.' '.$row->dmha_id;
                    }else{
                        if(strlen($row->dmha_id) == 6)
                        {
                            $isi .= ' &nbsp; &nbsp; &nbsp;';
                        }
                        elseif(strlen($row->dmha_id) == 8)
                        {                            
                            $isi .= ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;';
                        }
                        elseif(strlen($row->dmha_id) == 10)
                        {                            
                            $isi .= ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;';
                        }
                        elseif(strlen($row->dmha_id) == 12)
                        {                            
                            $isi .= ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;';
                        }

                        $isi .= $row->nama.' '.$row->dmha_id.' - '.strlen($row->dmha_id);                        
                    }
                    $isi .= '</label>';
                    $isi .= '</div>';
                }
            }

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_8a($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //---------------- input type 1
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= '<input type="file" ';
            $isi .= generate_attr_name_input_type($NAME,$FORM);
            $isi .= generate_attr_disabled_input_type($TIPE_DATA);

            $isi .= ' />';

        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_9($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //--------------- input type 14
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
            $counter = 0;
        // ------------------------------------------------------------------------- ACTION
            if($TIPE_PERTANYAAN_ID == 77) //----------------------------------------------- font awesome
            {
                $isi_model = data_002912::read_data_order_by_nama_asc();
            }


            $isi .= '                    
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="'.$NAME.'" 
                    id="defaultInlineRadio0" 
                    value="" checked/>
                    <label class="form-check-label" 
                    for="defaultInlineRadio'.$counter.'">Null</label>
                </div>
            ';

            if(!is_null($isi_model))
            {
                foreach ($isi_model as $row) 
                {  
                    $counter++;
                    $isi .= '                    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="'.$NAME.'" 
                            id="defaultInlineRadio1" 
                            value="'.$row->id.'" ';
                            if($VALUE == $row->id)
                                {$isi .= 'checked';}
                            $isi .= '/>
                            <label class="form-check-label" 
                            for="defaultInlineRadio'.$counter.'">';

                            if($TIPE_PERTANYAAN_ID == 77)
                                {$isi .= '<i class="'.$row->nama.' fa-2x"></i>';}
                            
                        $isi .=
                            '</label>
                        </div>
                    ';
                }
            }


        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_14($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //--------------- input type 14
        // ------------------------------------------------------------------------- INITIALIZE
        	$isi = '';
        // ------------------------------------------------------------------------- ACTION
            //$isi .= '<input type="checkbox" name="'.$NAME.'" data-render="switchery" data-theme="default" />';
            $isi .= '<input type="checkbox" name="'.$NAME.'" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text" ';

            $isi .= $VALUE;
            
            if($VALUE == 1)
            {
                $isi .= ' checked ';
            }

            $isi .= ' />';

            /*

            $isi .= '
            <div class="switcher">
                <input type="checkbox" name="'.$NAME.'" id="switcher_checkbox_1" ';
                    $isi .= $VALUE;            
                    if($VALUE == 1)
                    {$isi .= ' checked ';}

                $isi .= '>
                <label for="switcher_checkbox_1"></label>
            </div>';
            */


        // ------------------------------------------------------------------------- SEND
    		$words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_15($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //--------------- RANGE SLIDER
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            //$isi .= '<input type="text" id="customMinutes_rangeSlider" name="default_rangeSlider" value="" />';

            $isi .= '<input type="text" ';      
            $isi .= generate_attr_name_input_type($NAME,$FORM);
            $isi .= generate_attr_value_input_type($VALUE);

            if($TIPE_PERTANYAAN_ID == 51)
            {
                $isi .= ' id="customMinutes_rangeSlider" ';
            }
            elseif($TIPE_PERTANYAAN_ID == 81)
            {
                $isi .= ' id="customUrutan_rangeSlider" ';
            }
            $isi .= ' />';   


        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_16($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //--------------- Autoclose Date Picker 
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= '<input type="text" class="form-control datepicker-autoClose" ';
            $isi .= generate_attr_name_input_type($NAME,$FORM);
            $isi .= generate_attr_value_input_type($VALUE);
            $isi .= ' id="" />'; 

            /*
            $isi .= generate_attr_class_input_type($CLASS_PERTANYAANS);
            $isi .= generate_attr_id_input_type($ID);
            $isi .= generate_attr_value_input_type($VALUE);
            $isi .= generate_attr_placeholder_input_type($TIPE_PERTANYAAN_ID);
            $isi .= generate_attr_disabled_input_type($TIPE_DATA);
            */


        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

    function generate_new_input_type_17($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM){ //---------------- Number
        // ------------------------------------------------------------------------- INITIALIZE
            $isi = '';
        // ------------------------------------------------------------------------- ACTION
            $isi .= '<input type="number" ';
            $isi .= generate_attr_all_in_one($CLASS_PERTANYAANS,$NAME,$ID,$VALUE,$TIPE_DATA,$TIPE_PERTANYAAN_ID,$LABEL,$FORM);
            $isi .= ' />';         
        // ------------------------------------------------------------------------- SEND
            $words = $isi;
            return $words;
        ////////////////////////////////////////////////////////////////////////////
    }

