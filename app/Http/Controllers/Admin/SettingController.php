<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Display general settings.
     */
    public function general()
    {
        $settings = Setting::whereIn('group', ['general', 'contact', 'social'])->get()->keyBy('key');
        return view('admin.pages.settings.general', compact('settings'));
    }

    /**
     * Update general settings.
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'store_url' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
        ]);

        try {
            // General settings
            Setting::set('site_title', $request->site_title, 'string', 'general');
            Setting::set('site_tagline', $request->site_tagline, 'string', 'general');
            Setting::set('store_url', $request->store_url, 'string', 'general');

            // Contact settings
            Setting::set('contact_email', $request->contact_email, 'string', 'contact');
            Setting::set('contact_phone', $request->contact_phone, 'string', 'contact');

            // Social media settings
            Setting::set('facebook_url', $request->facebook_url, 'string', 'social');
            Setting::set('twitter_url', $request->twitter_url, 'string', 'social');
            Setting::set('instagram_url', $request->instagram_url, 'string', 'social');
            Setting::set('linkedin_url', $request->linkedin_url, 'string', 'social');
            Setting::set('youtube_url', $request->youtube_url, 'string', 'social');

            // Clear all settings cache
            Cache::flush();

            return back()->with('success', 'Settings updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update settings. Please try again.');
        }
    }

    /**
     * Display FAQs management.
     */
    public function faqs()
    {
        $faqs = Setting::where('group', 'faqs')->orderBy('created_at')->get();
        return view('admin.pages.settings.faqs', compact('faqs'));
    }

    /**
     * Store a new FAQ.
     */
    public function storeFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'is_active' => 'boolean'
        ]);

        try {
            $faqData = [
                'question' => $request->question,
                'answer' => $request->answer,
                'is_active' => $request->boolean('is_active', true)
            ];

            Setting::set(
                'faq_' . time() . '_' . rand(1000, 9999),
                json_encode($faqData),
                'json',
                'faqs'
            );

            return back()->with('success', 'FAQ added successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add FAQ. Please try again.');
        }
    }

    /**
     * Update an existing FAQ.
     */
    public function updateFaq(Request $request, $key)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'is_active' => 'boolean'
        ]);

        try {
            $faqData = [
                'question' => $request->question,
                'answer' => $request->answer,
                'is_active' => $request->boolean('is_active', true)
            ];

            Setting::set($key, json_encode($faqData), 'json', 'faqs');

            return back()->with('success', 'FAQ updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update FAQ. Please try again.');
        }
    }

    /**
     * Delete an FAQ.
     */
    public function destroyFaq($key)
    {
        try {
            Setting::where('key', $key)->where('group', 'faqs')->delete();
            Cache::forget("setting_{$key}");

            return back()->with('success', 'FAQ deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete FAQ. Please try again.');
        }
    }

    /**
     * Display roles and permissions.
     */
    public function roles()
    {
        $roles = \Spatie\Permission\Models\Role::with('permissions', 'users')->get();
        return view('admin.pages.settings.roles', compact('roles'));
    }

    /**
     * Display all settings groups.
     */
    public function index()
    {
        $settings = Setting::select('group')
            ->distinct()
            ->get()
            ->pluck('group');

        return view('admin.pages.settings.index', compact('settings'));
    }
}
