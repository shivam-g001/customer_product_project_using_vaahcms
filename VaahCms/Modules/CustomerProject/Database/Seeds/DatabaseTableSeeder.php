<?php
namespace VaahCms\Modules\CustomerProject\Database\Seeds;


use Illuminate\Database\Seeder;
use WebReinvent\VaahCms\Libraries\VaahSeeder;
use Illuminate\Support\Facades\DB;

class DatabaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds();
        VaahSeeder::permissions(__DIR__.'/json/permissions.json');
        $this->seedNotifications();
        $this->seedNotificationContent();

    }
    public function seedNotifications()
    {
        $list = VaahSeeder::getListFromJson(__DIR__ . "/json/notifications.json");
        VaahSeeder::storeSeedsWithUuid('vh_notifications', $list, 'slug', true, 'name', false);
    }
    public function seedNotificationContent()
    {
        $list = VaahSeeder::getListFromJson(__DIR__ . "/json/notification_contents.json");

        foreach ($list as $item) {
            $notification = DB::table('vh_notifications')
                ->where('slug', $item['slug'])
                ->first();

            if (!$notification) {
                continue;
            }

            $exist = DB::table('vh_notification_contents')
                ->where('vh_notification_id', $notification->id)
                ->where('sort', $item['sort'])
                ->where('via', $item['via'])
                ->first();

            $item['vh_notification_id'] = $notification->id;

            if (isset($item['meta'])) {
                $item['meta'] = json_encode($item['meta']);
            }

            unset($item['slug']);


            if (!$exist) {
                DB::table('vh_notification_contents')->insert($item);
            } else {
                DB::table('vh_notification_contents')
                    ->where('vh_notification_id', $notification->id)
                    ->where('sort', $item['sort'])
                    ->where('via', $item['via'])
                    ->update($item);
            }
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    function seeds()
    {

    }


}
