<?php

namespace Hsaldarriaga\placetopaylaravel;

use Illuminate\Support\ServiceProvider;

use Hsaldarriaga\placetopaylaravel\commands\BankCommand;
use Hsaldarriaga\placetopaylaravel\commands\TransactionCommand;

use Hsaldarriaga\placetopay\Transaction;

class PlaceToPayServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

	    $this->publishes([
	            __DIR__.'/config/placetopay.php' => config_path('placetopay.php'),
	        ]);
	    $this->loadMigrationsFrom(__DIR__.'/migrations');

	    if ($this->app->runningInConsole()) {
	            $this->commands([
	                BankCommand::class,
	                TransactionCommand::class,
	            ]);
	        }
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
	    $this->app->singleton(Transaction::class, function ($app) {
	    	$wsdl = config('placetopay.wsdl');
	    	$login = config('placetopay.login');
	    	$tranKey = config('placetopay.tranKey');
	    	return new Transaction($wsdl, $login, $tranKey);
	    });
	}
}