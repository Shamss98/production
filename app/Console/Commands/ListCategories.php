<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class ListCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:list {--tree : Display as tree structure}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all categories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('tree')) {
            $this->displayTree();
        } else {
            $this->displayList();
        }
    }

    private function displayList()
    {
        $categories = Category::with('parent')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $this->info('Categories List:');
        $this->newLine();

        $headers = ['ID', 'Name', 'Slug', 'Parent', 'Status', 'Sort Order'];
        $rows = [];

        foreach ($categories as $category) {
            $rows[] = [
                $category->id,
                $category->name,
                $category->slug,
                $category->parent ? $category->parent->name : 'Root',
                $category->is_active ? 'Active' : 'Inactive',
                $category->sort_order,
            ];
        }

        $this->table($headers, $rows);
    }

    private function displayTree()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $this->info('Categories Tree:');
        $this->newLine();

        foreach ($categories as $category) {
            $this->displayCategoryNode($category, 0);
        }
    }

    private function displayCategoryNode($category, $level)
    {
        $indent = str_repeat('  ', $level);
        $status = $category->is_active ? '✓' : '✗';
        $childrenCount = $category->children->count();
        
        $this->line("{$indent}{$status} {$category->name} ({$category->slug})");
        
        if ($childrenCount > 0) {
            $this->line("{$indent}  └─ {$childrenCount} subcategories");
            
            foreach ($category->children->sortBy('sort_order')->sortBy('name') as $child) {
                $this->displayCategoryNode($child, $level + 1);
            }
        }
    }
}
