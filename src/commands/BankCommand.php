<?php

namespace Hsaldarriaga\placetopaylaravel\commands;

use Illuminate\Console\Command;
use Hsaldarriaga\placetopay\Transaction;
use DB;

class BankCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:banks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get and save bank list';

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
        $banks = $transaction->getBankList();
        if (!is_null($banks)) {
            DB::table('banks')->truncate();
        }
        foreach ($banks as $bank) {
            DB::table('banks')->insert([
                    'id' => $bank->bankCode,
                    'name' => $bank->bankName
                ]);
        }
    }
}