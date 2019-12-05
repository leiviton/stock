<?php

namespace Stock\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Stock\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExportReady;

class NotifyUserExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $export;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $export)
    {
        $this->user = $user;
        $this->export = $export;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data = [
            'user'=>$this->user,
            'export'=> $this->export
        ];
        echo $this->user->email;
        Mail::to($this->user->email)->send(new ExportReady($data));

    }
}
