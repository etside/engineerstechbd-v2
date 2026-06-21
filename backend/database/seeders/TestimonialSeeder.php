<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name'      => 'Jeremy Nathan',
                'role'      => 'CEO',
                'company'   => 'Industracom, USA',
                'quote'     => 'engineersTech did an amazing job with this design. I really like how they interpreted our brand. I hope to work with them again soon!',
                'photo_url'     => null,
                'rating'        => 5,
                'display_order' => 1,
                'is_active'     => true,
            ],
            [
                'name'          => 'Freda Lin',
                'role'          => 'Design and Marketing Specialist',
                'company'       => 'Ample, Canada',
                'quote'         => 'engineersTech has an excellent eye for design and attention to detail. They were able to turn a quick project around within hours — impressive work, will be working together in the near future!',
                'photo_url'     => null,
                'rating'        => 5,
                'display_order' => 2,
                'is_active'     => true,
            ],
            [
                'name'          => 'Mynul Hasan',
                'role'          => 'Senior Auditor',
                'company'       => 'Intertek Bangladesh',
                'quote'         => 'engineersTech is an extremely passionate, talented, and achiever. They are very good designers and deliver projects on time. It is an absolute privilege to work with them.',
                'photo_url'     => null,
                'rating'        => 5,
                'display_order' => 3,
                'is_active'     => true,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name'], 'company' => $t['company']],
                $t
            );
        }
    }
}
