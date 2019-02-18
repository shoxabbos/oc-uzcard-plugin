<?php namespace Shohabbos\Uzcard\ReportWidgets;

use Db;
use Exception;
use Carbon\Carbon;
use Backend\Classes\ReportWidgetBase;
use Shohabbos\Uzcard\Models\Transaction;

class Payment extends ReportWidgetBase
{

    public function render()
    {
        try {
            $this->loadData();
        }
        catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }


    public function defineProperties()
	{
	    return [
	        'days' => [
	            'title'             => 'Oxirgi kunlik hisobotni kortatish',
	            'default'           => '0',
	            'type'              => 'string',
	            'validationPattern' => '^[0-9]+$'
	        ]
	    ];
	}

	protected function loadData()
    {
		$successQuery = Transaction::where('success', 1);
		$failQuery = Transaction::where('success', '!=', 1);


		if ($this->property('days')) {
			$day = Carbon::now()->subDays($this->property('days'));
			$this->vars['success'] = $successQuery->where('created_at', '>', $day)->get();
			$this->vars['fail'] = $failQuery->where('created_at', '>', $day)->get();
		} else {
			$this->vars['success'] = $successQuery->get();
			$this->vars['fail'] = $failQuery->get();
		}
    }


}