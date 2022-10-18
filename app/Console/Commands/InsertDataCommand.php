<?php

namespace App\Console\Commands;

use App\Models\DataModel;
use App\Models\ExchangeRate;
use Illuminate\Console\Command;

class InsertDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This create subjects and unlocks tables';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $subjects = [
            'english',
            'philosophy',
            'engineering',
            'mathematics',
            'literature',
            'creative writing',
            'psychology',
            'statistics',
            'history',
            'sociology',
            'business',
            'management',
            'marketing',
            'biology',
            'physics',
            'finance',
            'low',
            'nursing',
            'technology',
            'education',
            'economics',
            'chemistry',
            'communications',
            'ethics',
            'liguistics',
            'medicine and health',
            'nature',
            'political science',
            ' religion and theology',
            'tourism',
            'geography',
            'criminal justice',
            'I.T',
            'healthcare',
            'art',
            'usic',
            'international relations',
            'PHP/Laravel',
            'Java/Java android',
            'Kotlin',
            'Node js',
            'C/C#/C++',
            'React/React Native',
            'Spring/Spring Boot',
            'MYSQL',
            'medical writing',
            'others',

        ];



        $unlocks = [
            'Chegg Unlocks' => 0.42,
            'Course Hero Unlocks' => 0.42,
            'Studypool Unlocks' => 1.32,
            'Brainly Unlocks' => 0.42,
            'Quizlet Unlocks' => 0.42,
            'Gauthmaths Unlocks' => 0.42,
            'Socratic-org Unlocks' => 0.42,
            'Scribd Unlocks' => 1.22,
            'Bartleby Maths Unlocks' => 1.22,
            'Studocu Unlocks' => 1.22,
            'Transtutors Unlocks' => 1.32,
            'Bartleby essays' => 1.65,
            'Slideshare Unlocks' => 1.24,
            'Numerade Unlocks' => 1.32,
            'Academia Unlocks' => 1.24,
            'Quesba Unlocks' => 1.32,
            'Solutioninn Unlocks' => 1.32,
            'Study.com Unlocks' => 1.32,
            'Others' => 2.1,
        ];


        $finalSubjects = json_encode($subjects);
        $finalUnloks = json_encode($unlocks);


        DataModel::create([
            'subjects'=>$finalSubjects,
            'unlocks'=>$finalUnloks,
        ]);

        ExchangeRate::create([
            'deposit'=>121.6,
            'withdraw'=>119.2,
        ]);
        return true;
    }
}
