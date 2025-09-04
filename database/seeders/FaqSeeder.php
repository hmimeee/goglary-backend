<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How do I create an account?',
                'answer' => 'To create an account, click on the "Register" button in the top navigation menu. Fill in your name, email address, and password. You will receive a confirmation email to verify your account.',
                'is_active' => true
            ],
            [
                'question' => 'How do I reset my password?',
                'answer' => 'If you forgot your password, click on "Forgot Password" on the login page. Enter your email address and you will receive a password reset link.',
                'is_active' => true
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and bank transfers. All payments are processed securely.',
                'is_active' => true
            ],
            [
                'question' => 'How long does shipping take?',
                'answer' => 'Shipping times vary depending on your location. Standard shipping takes 3-5 business days, express shipping takes 1-2 business days. You will receive a tracking number once your order ships.',
                'is_active' => true
            ],
            [
                'question' => 'What is your return policy?',
                'answer' => 'We offer a 30-day return policy for most items. Items must be in their original condition and packaging. Please contact our customer service team to initiate a return.',
                'is_active' => true
            ],
            [
                'question' => 'Do you offer international shipping?',
                'answer' => 'Yes, we ship to most countries worldwide. International shipping rates and delivery times vary by location. Additional customs fees may apply.',
                'is_active' => true
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Setting::set(
                'faq_' . ($index + 1),
                json_encode($faq),
                'json',
                'faqs'
            );
        }
    }
}
