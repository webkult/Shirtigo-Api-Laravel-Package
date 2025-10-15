<?php

namespace LaravelShirtigo\Commands;

use Illuminate\Console\Command;
use LaravelShirtigo\Facades\Shirtigo;

class SyncProductsCommand extends Command
{
    protected $signature = 'shirtigo:sync-products
                            {--force : Force sync even if products are up to date}
                            {--limit=100 : Limit number of products to sync}';

    protected $description = 'Sync products from Shirtigo API';

    public function handle(): int
    {
        $this->info('Starting product sync...');

        try {
            $limit = (int) $this->option('limit');
            $force = $this->option('force');

            $this->info("Fetching products (limit: {$limit})...");

            $products = Shirtigo::products()->getAll();

            if (empty($products)) {
                $this->warn('No products found.');
                return self::SUCCESS;
            }

            $count = count($products);
            $this->info("Found {$count} products.");

            $bar = $this->output->createProgressBar($count);
            $bar->start();

            $synced = 0;
            dd($products);
            foreach ($products as $productData) {
                try {
                    dump($productData);
                    $synced++;
                } catch (\Exception $e) {
                    $this->error("Failed to sync product {$productData['id']}: " . $e->getMessage());
                }

                $bar->advance();
            }

            $bar->finish();
            $this->newLine();

            $this->info("Successfully synced {$synced} products.");

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Product sync failed: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
