<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeProfTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:proftest {name : Name of test.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create templates for adding a new career guidance test.';

    private $testCode;

    private $testNameLower;

    private $testNameUpper;

    private function createSeeder(string $stubFile, string $seederPath, string $seederName, array $replacements): void
    {
        if (!File::exists($stubFile)) {
            $this->error('TestSeeder: stub file does not exist.');
            return;
        }

        $content = File::get($stubFile);

        $content = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $content
        );

        $filePath = "{$seederPath}" . '/' . $seederName;

        File::ensureDirectoryExists(dirname($filePath));
        File::put($filePath, $content);

        $this->info("Seeder {$seederName} created successfully!");
    }

    public function handle()
    {
        $this->testNameUpper = ucfirst($this->argument('name'));
        $this->testNameLower = lcfirst($this->testNameUpper);

        $this->testCode = $this->testNameLower;

        $replacements = [
            '{{ testNameUpper }}' => $this->testNameUpper,
            '{{ testNameLower }}' => $this->testNameLower,
            '{{ testCode }}' => $this->testCode,
        ];

        
        $this->createSeeder(
            resource_path('stubs/Tests/TestSeeder.stub'), 
            database_path('seeders/Tests/Tests'), 
            "{$this->testNameUpper}TestSeeder.php",
            $replacements
        );
        
        $this->createSeeder(
            resource_path('stubs/Tests/TestBaseSeeder.stub'), 
            database_path('seeders/Tests/TestBases'), 
            "{$this->testNameUpper}TestBaseSeeder.php",
            $replacements
        );
        
        $this->createSeeder(
            resource_path('stubs/Tests/TestQuestionSeeder.stub'), 
            database_path('seeders/TestsData/TestQuestions'),
            "{$this->testNameUpper}TestQuestionSeeder.php", 
            $replacements
        );
        
        $this->createSeeder(
            resource_path('stubs/Tests/TestAnswerSeeder.stub'), 
            database_path('seeders/TestsData/TestAnswers'), 
            "{$this->testNameUpper}TestAnswerSeeder.php",
            $replacements
        );
        
        $this->createSeeder(
            resource_path('stubs/Tests/ActivityTypeTestBaseSeeder.stub'), 
            database_path('seeders/Relations/ActivityTypeTestBase'), 
            "{$this->testNameUpper}ActivityTypeTestBaseSeeder.php",
            $replacements
        );

        return 0;
    }
}
