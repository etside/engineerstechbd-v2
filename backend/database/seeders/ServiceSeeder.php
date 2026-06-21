<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['title' => 'Enterprise & SaaS Development', 'description' => 'End-to-end enterprise applications and SaaS platforms built for scale. We architect multi-tenant systems, API-first backends, and robust cloud infrastructure.', 'icon' => 'Building2', 'display_order' => 1],
            ['title' => 'Web & Mobile Applications', 'description' => 'Beautiful, performant web and mobile apps using React, Vue, Next.js, Flutter, and React Native. From MVPs to production-grade products.', 'icon' => 'Smartphone', 'display_order' => 2],
            ['title' => 'UI/UX & Motion Design', 'description' => 'Human-centered design with stunning interfaces. We craft design systems, interactive prototypes, and motion-rich experiences that convert.', 'icon' => 'Palette', 'display_order' => 3],
            ['title' => 'Technical Consultation', 'description' => 'Strategic tech guidance for startups and enterprises. Architecture reviews, team augmentation, code audits, and AI integration roadmaps.', 'icon' => 'Lightbulb', 'display_order' => 4],
        ];
        foreach ($services as $s) Service::firstOrCreate(['title' => $s['title']], $s);
    }
}
