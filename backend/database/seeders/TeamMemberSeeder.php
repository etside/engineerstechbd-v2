<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name'          => 'Nazmul Alom Sakib',
                'designation'   => 'Founder & CEO',
                'bio'           => 'Visionary leader who started the company from Upwork freelancing and built it into a full-scale software engineering firm. Expert in enterprise architecture and team leadership. 10+ years experience.',
                'photo_url'     => null,
                'linkedin_url'  => null,
                'display_order' => 1,
                'is_active'     => true,
            ],
            [
                'name'          => 'Al Shahriar',
                'designation'   => 'Co-founder & COO',
                'bio'           => 'Operations strategist ensuring every project runs smoothly from kickoff to delivery. Specializes in process optimization and client relationship management. 8+ years experience.',
                'photo_url'     => null,
                'linkedin_url'  => null,
                'display_order' => 2,
                'is_active'     => true,
            ],
            [
                'name'          => 'Sheikh Md. Junaeid',
                'designation'   => 'Co-Founder & CMO',
                'bio'           => 'Marketing and growth expert driving brand visibility and business development. Passionate about connecting the right solutions with the right clients. 10+ years experience.',
                'photo_url'     => null,
                'linkedin_url'  => null,
                'display_order' => 3,
                'is_active'     => true,
            ],
        ];

        foreach ($members as $m) {
            TeamMember::updateOrCreate(['name' => $m['name']], $m);
        }
    }
}
