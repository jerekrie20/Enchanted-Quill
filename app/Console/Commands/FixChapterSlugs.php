<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixChapterSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chapters:fix-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix empty chapter slugs and titles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing chapter slugs and titles...');

        $chapters = DB::table('chapters')->get();
        $fixed = 0;

        foreach ($chapters as $chapter) {
            $updates = [];

            if (empty($chapter->title)) {
                $updates['title'] = 'Chapter '.$chapter->chapter_number;
            }

            if (empty($chapter->slug)) {
                $updates['slug'] = 'chapter-'.$chapter->chapter_number.'-'.uniqid();
            }

            if (! empty($updates)) {
                DB::table('chapters')->where('id', $chapter->id)->update($updates);
                $fixed++;
            }
        }

        $this->info("Fixed {$fixed} chapters!");

        return 0;
    }
}
