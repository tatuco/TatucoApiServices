<?php

namespace App\Reports\src;


use App\Reports\src\Facades\CSVReportFacade;
use App\Reports\src\Facades\ExcelReportFacade;
use App\Reports\src\Facades\PdfReportFacade;
use App\Reports\src\ReportMedia\CSVReport;
use App\Reports\src\ReportMedia\ExcelReport;
use App\Reports\src\ReportMedia\PdfReport;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $configPath = __DIR__.'/../config/report-generator.php';
        $this->mergeConfigFrom($configPath, 'report-generator');

        $this->app->bind('pdf.report.generator', function ($app) {
            return new PdfReport ($app);
        });
        $this->app->bind('excel.report.generator', function ($app) {
            return new ExcelReport ($app);
        });
        $this->app->bind('csv.report.generator', function ($app) {
            return new CSVReport ($app);
        });
      //  $this->app->register('Maatwebsite\Excel\ExcelServiceProvider');

        $this->registerAliases();
	}

	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/views', 'report-generator-view');

		$this->publishes([
	        __DIR__.'/../config/report-generator.php' => config_path('report-generator.php')
	    ], 'config');
	}

	protected function registerAliases()
	{
	    if (class_exists('Illuminate\Foundation\AliasLoader')) {
	        $loader = AliasLoader::getInstance();
	        $loader->alias('PdfReport', PdfReportFacade::class);
	        $loader->alias('ExcelReport', ExcelReportFacade::class);
	        $loader->alias('CSVReport', CSVReportFacade::class);
	    }
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
