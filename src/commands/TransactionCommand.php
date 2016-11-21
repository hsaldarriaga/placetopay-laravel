<?php

namespace Hsaldarriaga\placetopaylaravel\commands;

use Illuminate\Console\Command;
use Hsaldarriaga\placetopay\Transaction;
use DB;
use Carbon\Carbon;

class TransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:consult';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'verify and test transactions';

    /**
     * The transaction class.
     *
     * @var Transaction
     */
    protected $transaction;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        parent::__construct();

        $this->transaction = $transaction;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$nowMinusSeven = Carbon::now()->subMinutes(7); 
        $response = DB::table('transactions')
        		->where('updated_at', '>', $nowMinusSeven)
        		->where('transactionState', 'PENDING')->get();
        foreach ($response as $trans) {
            $state = $transaction->getTransactionInformation($trans->$transactionID);
            DB::table('transactions')->where('id', $trans->id)->update([
                    'transactionState' => $state->transactionState,
                    'responseCode' => $state->responseCode,
                    'responseReasonCode' => $state->responseReasonCode,
                    'responseReasonText' => $state->responseReasonText,
                    'returnCode' => $state->returnCode
                ]);
        }
    }
}