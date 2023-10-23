<?PHP
namespace App\Jobs;

use App\Mail\HelloEmail;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Event\Code\Throwable;

class MatchSendEmail implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $item;
    protected $email;

    public function __construct($item, $email)
    {
        $this->item = $item;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new HelloEmail($this->item, $this->email);
        Mail::to($this->email)->send($email);
        if ($this->batch()->cancelled()) {


return;
        }
    }



}
