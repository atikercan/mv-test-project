<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CSVReport extends Mailable
{
    use Queueable, SerializesModels;

	private $csvFileContents;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($csvFileContents)
    {
        //
		$this->csvFileContents = $csvFileContents;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.csv-report')
				->attachData($this->csvFileContents, "csv-report.csv");
    }
}
