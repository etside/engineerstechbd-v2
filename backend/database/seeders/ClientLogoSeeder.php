<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientLogo;

class ClientLogoSeeder extends Seeder
{
    public function run(): void
    {
        $logos = [
            ['name' => 'Industracom',  'logo_url' => null, 'website_url' => null, 'display_order' => 1, 'is_active' => true],
            ['name' => 'Ample',        'logo_url' => null, 'website_url' => null, 'display_order' => 2, 'is_active' => true],
            ['name' => 'Intertek',     'logo_url' => null, 'website_url' => null, 'display_order' => 3, 'is_active' => true],
            ['name' => 'Client Four',  'logo_url' => null, 'website_url' => null, 'display_order' => 4, 'is_active' => true],
            ['name' => 'Client Five',  'logo_url' => null, 'website_url' => null, 'display_order' => 5, 'is_active' => true],
            ['name' => 'Client Six',   'logo_url' => null, 'website_url' => null, 'display_order' => 6, 'is_active' => true],
        ];

        foreach ($logos as $logo) {
            ClientLogo::updateOrCreate(['name' => $logo['name']], $logo);
        }
    }
}
