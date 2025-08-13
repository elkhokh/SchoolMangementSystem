<?php

namespace Database\Seeders;

use App\Models\Subjects;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['name' => 'اللغة العربية', 'degree' => 100, 'note' => 'تشمل القراءة، الكتابة، النحو، الإملاء، والتعبير'],
            ['name' => 'الرياضيات', 'degree' => 60, 'note' => 'تتضمن العمليات الحسابية، الهندسة، الجبر البسيط، وحل المشكلات'],
            ['name' => 'الدراسات الاجتماعية', 'degree' => 60, 'note' => 'تشمل التاريخ، الجغرافيا، والتربية الوطنية.'],
            ['name' => 'العلوم', 'degree' => 60, 'note' => 'تتناول المفاهيم العلمية الأساسية مثل الطبيعة، الكائنات الحية، والفيزياء البسيطة'],
            ['name' => 'اللغة الإنجليزية', 'degree' => 60, 'note' => 'تُدرَّس كلغة أجنبية أولى، مع التركيز على القراءة، الكتابة، والمحادثة.'],
            ['name' => 'التربية الدينية', 'degree' => 60, 'note' => '(إسلامية أو مسيحية حسب دين الطالب)، تركز على القيم والأخلاق.'],
            ['name' => 'التربية الفنية', 'degree' => 40, 'note' => 'تشمل الرسم، الأشغال الفنية، والإبداع.'],
            ['name' => 'التربية الرياضية', 'degree' => 40, 'note' => 'تُعنى باللياقة البدنية والأنشطة الرياضية.'],
            ['name' => 'تكنولوجيا المعلومات والاتصالات (ICT)', 'degree' => 40, 'note' => 'تُدرَّس في بعض الصفوف لتعليم المهارات الرقمية الأساسية.'],
        ];

        foreach ($subjects as $subject) {
            Subjects::firstOrCreate(
                ['name' => $subject['name']],
                [
                    'degree' => $subject['degree'],
                    'note'   => $subject['note']
                ]
            );
        }
    }
}
