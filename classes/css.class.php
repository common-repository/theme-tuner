<?php
class ttCss {
	var $css=array();

	function __construct() {
		$this->css['color']=array('attr'=>'color','type'=>'color');
		$this->css['background-color']=array('attr'=>'background-color','type'=>'color');
	}

	function add($post) {
		$stylej=get_option('theme-tuner-css');
		$stylea=json_decode($stylej,true);
		//print_r($stylea);
		$p=empty($post['tt-tag']) ? '' : $post['tt-tag'];
		
		if (!empty($post['tt-id'])) {
			$c=$post['tt-id'];
			foreach ($this->css as $i => $a) {
				if (!empty($post['tt-'.$i])) {
					$stylea[$p.'#'.$c][$i]=($a['type']=='color' ? '#' : '').$post['tt-'.$i];
				}
			}
		} elseif (!empty($post['tt-class'])) {
			$cs=explode(' ',$post['tt-class']);
			foreach ($cs as $c) {
				foreach ($this->css as $i => $a) {
					if (!empty($post['tt-'.$i])) {
						$stylea[$p.'.'.$c][$i]=($a['type']=='color' ? '#' : '').$post['tt-'.$i];
					}
				}
			}
			//print_r($stylea);
		} else {
			echo 'Nothing to save';
		}
		$stylej=json_encode($stylea);
		update_option('theme-tuner-css',$stylej);
	}

	function render() {
		$stylej=get_option('theme-tuner-css');
		$stylea=json_decode($stylej,true);
		$c='';
		foreach ($stylea as $id => $style) {
			$c.=$id.' {';
			foreach ($style as $a => $u) {
				$c.=$a.':'.$u.';';
			}
			$c.='}';
		}
		return $c;
	}
}