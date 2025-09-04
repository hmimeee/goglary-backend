<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_title',
                'value' => 'GoGlary',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Site Title',
                'description' => 'The main title of your website'
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Your Premium E-commerce Store',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Site Tagline',
                'description' => 'A short description of your store'
            ],
            [
                'key' => 'store_url',
                'value' => 'https://goglary.com',
                'type' => 'string',
                'group' => 'general',
                'label' => 'Store URL',
                'description' => 'Your store\'s main URL'
            ],

            // Contact Settings
            [
                'key' => 'contact_email',
                'value' => 'support@goglary.com',
                'type' => 'string',
                'group' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Primary contact email address'
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1 (555) 123-4567',
                'type' => 'string',
                'group' => 'contact',
                'label' => 'Contact Phone',
                'description' => 'Primary contact phone number'
            ],

            // Social Media Settings
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/goglary',
                'type' => 'string',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Your Facebook page URL'
            ],
            [
                'key' => 'twitter_url',
                'value' => 'https://twitter.com/goglary',
                'type' => 'string',
                'group' => 'social',
                'label' => 'Twitter URL',
                'description' => 'Your Twitter profile URL'
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/goglary',
                'type' => 'string',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Your Instagram profile URL'
            ],
            [
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/company/goglary',
                'type' => 'string',
                'group' => 'social',
                'label' => 'LinkedIn URL',
                'description' => 'Your LinkedIn company page URL'
            ],
            [
                'key' => 'youtube_url',
                'value' => 'https://youtube.com/@goglary',
                'type' => 'string',
                'group' => 'social',
                'label' => 'YouTube URL',
                'description' => 'Your YouTube channel URL'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
