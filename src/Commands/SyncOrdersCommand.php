<?php

namespace LaravelShirtigo\Commands;

use Illuminate\Console\Command;
use LaravelShirtigo\Facades\Shirtigo;

class SyncOrdersCommand extends Command
{
    protected $signature = 'shirtigo:sync-orders 
                            {--status= : Filter by order status}
                            {--limit=50 : Limit number of orders to sync}
                            {--page=1 : Page number to start from}';

    protected $description = 'Sync orders from Shirtigo API';

    public function handle(): int
    {
        $this->info('Starting order sync...');

        try {
            $status = $this->option('status');
            $limit = (int) $this->option('limit');
            $page = (int) $this->option('page');

            $this->info("Fetching orders (page: {$page}, limit: {$limit})...");

            $orders = Shirtigo::orders()->getAll(
                page: $page,
                filter: $status ? (int) $status : null,
                items: $limit
            );

            if (empty($orders['data'] ?? [])) {
                $this->warn('No orders found.');
                return self::SUCCESS;
            }

            $orderData = $orders['data'];
            $count = count($orderData);
            $this->info("Found {$count} orders.");

            $bar = $this->output->createProgressBar($count);
            $bar->start();

            $synced = 0;
            foreach ($orderData as $order) {
                try {
                    // Hier würde die eigentliche Sync-Logik stehen
                    // z.B. Speicherung in lokaler Datenbank
                    $synced++;
                } catch (\Exception $e) {
                    $this->error("Failed to sync order {$order['reference']}: " . $e->getMessage());
                }

                $bar->advance();
            }

            $bar->finish();
            $this->newLine();

            $this->info("Successfully synced {$synced} orders.");

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Order sync failed: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}