<?php
declare(strict_types=1);

namespace Pggns\CleanerBake\View\Helper;

use Bake\Utility\Model\AssociationFilter;
use Bake\View\Helper\BakeHelper;
use Brick\VarExporter\VarExporter;
use Cake\Core\Configure;
use Cake\Core\ConventionsTrait;

/**
 * Clean Bake helper
 */
class CleanBakeHelper extends BakeHelper {
	use ConventionsTrait;
	
	/**
	 * Default configuration.
	 *
	 * @var array
	 */
	protected $_defaultConfig	=	[];
	
	/**
	 * AssociationFilter utility
	 *
	 * @var \Bake\Utility\Model\AssociationFilter|null
	 */
	protected $_associationFilter	=	null;
	
	/**
	 * Returns an array converted into a formatted multiline string
	 *
	 * @param array $list array of items to be stringified
	 * @param array $options options to use
	 * @return string
	 */
	public function stringifyList(array $list, array $options = []): string {
		$defaults	=	Configure::read('Pggns.CleanerBake.stringifyList');
		
		$options	=	array_merge($defaults, $options);
		
		if(!$list) {
			return '';
		}
		
		$max_key_length	=	0;
		if($options['align']) {
			foreach($list AS $k => &$v) {
				if(!is_numeric($k)) {
					$key_length	=	strlen($k);
					
					if($key_length > $max_key_length) {
						$max_key_length	=	$key_length;
					}
				}
			}
			
			$max_key_length	+=	2;
			
			$tab_length		=	$options['tabLength'];
			$does_fit		=	$max_key_length % $tab_length === 0;
			$max_tab_count	=	floor($max_key_length / $tab_length) + 1;
		}
		
		foreach($list as $k => &$v) {
			if($options['quotes']) {
				$v	=	"'$v'";
			}
			
			if(!is_numeric($k)) {
				$nestedOptions	=	$options;
				
				if($nestedOptions['indent']) {
					$nestedOptions['indent']	+=	1;
				}
				
				$tab	=	$options['tab'];
				
				if($options['align']) {
					$tab_length		=	$options['tabLength'];
					$key_length		=	strlen($k) + 2;
					
					$diff			=	$max_key_length - $key_length;
					$does_fit		=	$key_length % $tab_length === 0;
					$tab_count		=	floor($key_length / $tab_length);
					
					$tab_count_diff	=	$max_tab_count - $tab_count;
					
					$tabs			=	str_repeat($tab, (int) $tab_count_diff);
				} else {
					$tabs			=	$tab;
				}
				
				if(is_array($v)) {
					$v	=	sprintf(
								"'%s'%s=>%s[%s]",
								$k,
								$tabs,
								$tab,
								$this->stringifyList($v, $nestedOptions)
							);
				} else {
					if(is_bool($v)) {
						$v	=	$v ? 'true' : 'false';
					}
					
					$v	=	"'$k'$tabs=>$tab$v";
				}
			} elseif(is_array($v)) {
				$nestedOptions	=	$options;
				
				if($nestedOptions['indent']) {
					$nestedOptions['indent']	+=	1;
				}
				
				$v	=	sprintf(
							'[%s]',
							$this->stringifyList($v, $nestedOptions)
						);
			}
		}
		
		$start	=	'';
		$end	=	'';
		$join	=	', ';
		
		if($options['indent']) {
			$join	=	',';
			$start	=	"\n".str_repeat($options['tab'], $options['indent']);
			
			$join	.=	$start;
			$end	=	"\n".str_repeat($options['tab'], $options['indent'] - 1);
		}
		
		if($options['trailingComma']&&$options['indent'] > 0) {
			$end	=	','.$end;
		}
		
		return $start.implode($join, $list).$end;
	}
}
