<?php

/**
 * Command line interface Helper.
 *
 */
class Helper {
	
	/**
	 * execCommand
	 * 
	 * @access protected
	 * @return 
	 */
	protected function execCommand(){
		if(isset($this->commands[$this->command])){
			$method = $this->commands[$this->command];
			$rcode =  $this->$method();
		}else
			$rcode = $this->error("Command <$this->command> doesn't exist. Try <help>");
		return ($rcode == null) ? 0 : $rcode;
	}
	
	/**
	 * gopt
	 *
	 * @access protected
	 * @param
	 * @return
	 */
	protected function gopt($no){
		if(isset($this->options[$no]))
			return $this->options[$no];
		return null;
	}
	
	/**
	 * glopt
	 *
	 * @access protected
	 * @param
	 * @return
	 */
	protected function glopt($opt){
		foreach($this->options as $option){
			if(strpos($option, "--$opt=") !== false)
				return trim(end(explode('=', $option)), '"');
		}
		return null;
	}
	
	/**
	 * reqopt
	 *
	 * @param
	 * @param
	 * @return
	 */
	protected function reqopt($no, $name){
		if($this->gopt($no) == null)
			exit($this->error("Param $name is required. Try <help>"));
		return $this->gopt($no);
	}
	
	/**
	 * error
	 *
	 * @access protected
	 * @param
	 * @param
	 * @return
	 */
	protected function error($message = '', $errno = 1){
		if($message != '')
			echo Color::str("ERROR: $message\n", Empir::ERR_COLOR);
		return $errno;
	}
	
	/**
	 * success
	 *
	 * @access protected
	 * @param 
	 */
	protected function success($message){
		echo Color::str("$message\n", Empir::SUCCESS_COLOR);
	}
	
	/**
	 * makeAbsolut
	 *
	 * @access protected
	 * @param
	 * @return
	 */
	protected function makeAbsolut($path=''){
		$current = getcwd().'/';
		if($path === "" || $path === false)
			$absolut_path = $current;
		elseif(substr($path, 0, 2) == './')
			$absolut_path = $current.substr($path, 2);
		elseif(strpos($path, ':') === 1 || substr($path, 0, 2) == '\\\\' || substr($path, 0, 1) == '/')
			$absolut_path = $path;
		else
			$absolut_path = $current.$path;
		
		$absolut_path = str_replace('\\', '/', $absolut_path);
		$absolut_path = rtrim($absolut_path, '/');
		
		return $absolut_path;
	}
}

