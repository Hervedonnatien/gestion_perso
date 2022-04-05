<?php 
	if (!function_exists('date_complete') {
		function date_complete($date1)
	      {
	        $tab_mois= array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre');
	        $date_done=date('d',strtotime($date1)).' '.$tab_mois[date('m',strtotime($date1))-1].' '.date('Y',strtotime($date1));
	        return $date_done;
	      }
	}

 ?>