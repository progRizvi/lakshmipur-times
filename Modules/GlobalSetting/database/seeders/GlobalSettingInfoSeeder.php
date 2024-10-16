<?php

namespace Modules\GlobalSetting\database\seeders;

use Illuminate\Database\Seeder;
use Modules\GlobalSetting\app\Models\Setting;

class GlobalSettingInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();

        $setting_data = [
            'app_name' => 'Lakshmipur Times',
            'editor' => 'Lakshmipur Times',
            'address' => 'বাগবাড়ি, লক্ষ্মীপুর সদর, লক্ষ্মীপুর - ৩৭০০',
            'version' => '1.00',
            'phone' => '+৮৮০ ১৯৯৮ ৩০৪৭০১',
            'whatsapp' => '+৮৮০ ১৯৯৮ ৩০৪৭০১',
            'email' => 'lakshmipurtimes24@gmail.com',
            'logo' => 'uploads/website-images/logo.png',
            'timezone' => 'Asia/Dhaka',
            'date_format' => 'Y-m-d',
            'channel' => 'https://www.youtube.com/playlist?list=PLCEH8lWGo0VEiD4Rm7FoWRCapX5XweDbU',
            'time_format' => 'h:i A',
            'favicon' => 'uploads/website-images/favicon.png',
            'copyright_text' => '© 2024, Lakshmipur Times. All Rights Reserved.',
            'recaptcha_site_key' => 'recaptcha_site_key',
            'recaptcha_secret_key' => 'recaptcha_secret_key',
            'recaptcha_status' => 'inactive',
            'default_avatar' => 'uploads/website-images/default-avatar.png',
            'breadcrumb_image' => 'uploads/website-images/breadcrumb-image.jpg',
            'maintenance_mode' => 0,
            'maintenance_image' => 'uploads/website-images/maintenance.jpg',
            'maintenance_title' => 'Website Under maintenance',
            'maintenance_description' => '<p>We are currently performing maintenance on our website to<br>improve your experience. Please check back later.</p>
            <p><a title="Lakshmipur Times" href="">Lakshmipur Times</a></p>',
            'last_update_date' => date('Y-m-d H:i:s'),
            'comments_auto_approved' => 'active',
        ];

        foreach ($setting_data as $index => $setting_item) {
            $new_item = new Setting();
            $new_item->key = $index;
            $new_item->value = $setting_item;
            $new_item->save();
        }
    }
}
