<?php

namespace App\Reports\src\Facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * @see \Jimmyjs\ReportGenerator\ReportMedia\ExcelReport
 */
class ExcelReportFacade extends IlluminateFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'excel.report.generator';
    }
}
