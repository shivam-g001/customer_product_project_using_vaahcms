<?php

namespace App\Jobs;
//
//use Illuminate\Bus\Batchable;
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldBeUnique;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Queue\SerializesModels;
//use VaahCms\Modules\CustomerProject\Models\Customer;
//
//class FillItemJob implements ShouldQueue
//{
//    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
//
//    public $is_response_return;
//
//    public function __construct($is_response_return = true)
//    {
//        $this->is_response_return = $is_response_return;
//    }
//    /**
//     * Execute the job.
//     */
//    public function handle(): void
//    {
//        Customer::seedSampleItems($this->is_response_return);
//        if ($this->batch()->cancelled()) {
//            return;
//        }
//
//    }
//}

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use VaahCms\Modules\CustomerProject\Models\Customer;

class FillItemJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $action;
    protected $records;

    public function __construct($action, $records)
    {
        $this->action = $action;
        $this->records = $records;
    }

    public function handle()
    {
        for ($i = 0; $i < $this->records; $i++) {
            $data = Customer::fillItem(true);
            $customer = new Customer();
            $customer->fill($data['data']['fill']);
            $customer->save();
        }
    }
}




