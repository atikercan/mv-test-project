<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SplTempFileObject;
use App\Company;
use App\Mail\CSVReport;
use Mail;

class SendCSVReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:csv {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a csv report to given email address.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */ 
    public function handle()
    {
		$email = $this->argument('email');
		
		
		$file = fopen('php://temp', 'w+');  
		
		fputcsv($file, ['Company ID', 'Company Name', 'Total Dollars Raised', 'Total Fees']);
		
		$companies = Company::with(["investments"])->get();
		
		foreach($companies as $company) {
			fputcsv($file, [
				$company->id,
				$company->name,
				$company->investments()->sum("amount"),
				$company->investments()->sum("fees")
			]);
		}
		rewind($file); 
		
		$csvFileContents = stream_get_contents($file);
		Mail::to($email)->send(new CSVReport($csvFileContents));
		 
        $this->info('CSV report has been sent successfuly!');
		
    }
}
