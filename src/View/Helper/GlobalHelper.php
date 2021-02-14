<?php 
/* src/View/Helper/GlobalHelper.php (using other helpers) */

namespace App\View\Helper;

use Cake\View\Helper;

class GlobalHelper extends Helper
{
    public $helpers = ['Html'];

	public function yesOrNo()
	{
		$yesno = [
			0 => '<span class="badge badge-warning">No</span>',
			1 => '<span class="badge badge-success">Si</span>'
		];
		return $yesno;
	}

	public function status()
	{
		$status = [
			false => '<span class="badge badge-warning">Inactivo</span>',
			true => '<span class="badge badge-success">Activo</span>'
		];
		return $status;
	}

}
