<?php
function header_menu(){
	$output='<a class="showMenu" href="'.home_url().'/#home"><i class="fa-home fa icon-x back"></i></a>
           <a class="showMenu"><i class="fa-bars fa icon-x back"></i></a>
           <a class="showMenu"><i class="fa-search fa icon-x back"></i></a>'; 
		return $output;
}
?>