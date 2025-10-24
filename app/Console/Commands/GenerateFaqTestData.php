<?php

namespace App\Console\Commands;

use App\Models\Faq;
use App\Enums\FaqCategory;
use Illuminate\Console\Command;

class GenerateFaqTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faq:generate-test-data {--count=10 : Number of FAQs to generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate additional test FAQs for development';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->option('count');
        
        $this->info("❓ Generating {$count} additional FAQs...");

        $categories = FaqCategory::cases();
        
        $bar = $this->output->createProgressBar($count);
        $bar->start();

        for ($i = 0; $i < $count; $i++) {
            Faq::factory()
                ->forCategory($categories[array_rand($categories)])
                ->create();

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info("✅ Generated {$count} FAQs successfully!");
        $this->info("📊 Total FAQs: " . Faq::count());
        $this->info("📊 Active FAQs: " . Faq::active()->count());
        
        // Show breakdown by category
        foreach (FaqCategory::cases() as $category) {
            $categoryCount = Faq::where('category', $category)->count();
            $this->info("📊 {$category->value}: {$categoryCount}");
        }

        return 0;
    }
}
