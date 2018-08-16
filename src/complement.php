<?php	
    
    include dirname(__FILE__).'\pages\snappy_css.tpl';
    /**
	 * ------------------------------------------
	 *				_MESSAGE
	 * ------------------------------------------
     * @param strign $message
     * @param strign $type
	 */
	function _MESSEGE($message='', $type='', $structure='', $db=''){
		echo '   
        <div class="_mg_34fgt vl_wrapper">
            <div class="_cd_hj789">
                <div class="_hd_78ujk">                    
                    <span>Snappy '.$db.'</span>
                </div>
                <div class="_by_drf45">
                    '.$message.'
                    <span>'.$structure.'<span>
                </div>
                <div class="_fo_fgt67">
                    &copy; 2018 Snappy - error code: '.$type.'
                </div>
            </div>
        </div>		';
	}

    function _HELP($message='', $help='', $db='', $more){
        print_r('   
        <div class="_mg_34fgt vl_wrapper">
            <div class="_cd_hj789">
                <div class="_hd_78ujk">                    
                    <span>Snappy '.$db.'</span>
                </div>
                <div class="_by_drf45">
                    '.$message.'
                    <span class="xl">'.$more.'<span>
                </div>
                <div class="_fo_fgt67">
                    &copy; 2018 Snappy - help: '.$help.'
                </div>
            </div>
            <div class="btx--">
                <div></div>                
            </div>
        </div>
        ');
    }


    /**
     * ------------------------------------------
     *              _STRUCTURE
     * ------------------------------------------
     * @param strign $msg
     * @param strign $db
     * @param strign $url
     * @param strign $user
     */
    function _INFO($msg='', $server='', $client='', $host='', $server_version='', $protocol=''){
        echo '
        <div class="_mg_34fgt">
            <div class="_cd_hj789">
                <div class="_hd_78ujk">                    
                    <span>Snappy</span>
                </div>
                <div class="_by_drf45">
                    '.$msg.'<br>
                    <span class="xl"><i>'.$server.'</i>,</span>
                    <span class="xl"><i>'.$client.'</i>,</span>
                    <span class="xl"><i>'.$host.'</i></span>
                    <span class="xl"><i>'.$server_version.'</i></span>
                    <span class="xl"><i>'.$protocol.'</i></span>
                    <span>Estado del servidor</span>
                    <div class="connect">
                        Conectado
                    </div>
                </div>
                <div class="_fo_fgt67">
                    &copy; 2018 Snappy
                </div>
            </div>
        </div>      ';
    }    
?>