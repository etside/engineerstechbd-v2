<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'GlowUp', 'description' => 'AI-powered social media growth platform for influencers and brands.', 'display_order' => 1],
            ['name' => 'Restaurant POS', 'description' => 'Full-featured point-of-sale system for restaurants, cafes, and food chains.', 'display_order' => 2],
            ['name' => 'Tour Booking System', 'description' => 'End-to-end tour booking platform with real-time availability and payments.', 'display_order' => 3],
            ['name' => 'HRM Suite', 'description' => 'Human resource management with payroll, attendance, and performance tracking.', 'display_order' => 4],
            ['name' => 'Hotel Booking', 'description' => 'Hotel management and online booking system with channel management.', 'display_order' => 5],
            ['name' => 'CRM Platform', 'description' => 'Customer relationship management with pipeline tracking and automation.', 'display_order' => 6],
            ['name' => 'Staff Tracking', 'description' => 'Real-time staff location and task management for field teams.', 'display_order' => 7],
        ];
        foreach ($products as $p) Product::firstOrCreate(['name' => $p['name']], $p);
    }
}
