<?php

namespace LaravelShirtigo\Services\Api;

use Webkult\Api\Shirtigo\WebkultApiShirtigo;

class OrderService extends BaseApiService
{
    public function __construct(WebkultApiShirtigo $client)
    {
        parent::__construct($client);
    }

    public function getAll(
        int $page = 1,
        ?int $filter = null,
        int $items = 50,
        ?string $search = null,
        ?string $sortCol = null,
        ?string $sortDir = null,
        ?int $period = null,
        ?int $secondaryFilter = null
    ): array {
        $cacheKey = "orders_all_{$page}_{$filter}_{$items}_{$search}_{$sortCol}_{$sortDir}_{$period}_{$secondaryFilter}";

        return $this->executeWithCache($cacheKey, function () use (
            $page, $filter, $items, $search, $sortCol, $sortDir, $period, $secondaryFilter
        ) {
            $response = $this->client->orderApi()->getAllOrders(
                $page, $filter, $items, $search, $sortCol, $sortDir, $period, $secondaryFilter
            );

            return $this->handleResponse($response);
        });
    }

    public function get(string $orderReference): array
    {
        $cacheKey = "order_{$orderReference}";

        return $this->executeWithCache($cacheKey, function () use ($orderReference) {
            $response = $this->client->orderApi()->getOrder($orderReference);
            return $this->handleResponse($response);
        });
    }

    public function create(array $data): array
    {
        $response = $this->client->orderApi()->createOrder();
        return $this->handleResponse($response);
    }

    public function updateDeliveryAddress(string $orderReference, array $addressData): array
    {
        $response = $this->client->orderApi()->updateDeliveryAddress($orderReference);
        return $this->handleResponse($response);
    }

    public function cancel(string $orderReference): array
    {
        $response = $this->client->orderApi()->cancelOrder($orderReference);
        return $this->handleResponse($response);
    }

    public function retryPayment(string $orderReference): array
    {
        $response = $this->client->orderApi()->retryPayment($orderReference);
        return $this->handleResponse($response);
    }

    public function addComment(string $orderReference, string $comment): array
    {
        $response = $this->client->orderApi()->addOrderComment($orderReference);
        return $this->handleResponse($response);
    }

    public function getInvoice(string $orderReference): array
    {
        $cacheKey = "order_invoice_{$orderReference}";

        return $this->executeWithCache($cacheKey, function () use ($orderReference) {
            $response = $this->client->orderApi()->retrieveOrderInvoice($orderReference);
            return $this->handleResponse($response);
        });
    }

    public function calculatePrice(array $data): array
    {
        $response = $this->client->orderApi()->calculatePrice();
        return $this->handleResponse($response);
    }

    public function getAvailableFulfillmentModes(): array
    {
        $cacheKey = 'fulfillment_modes';

        return $this->executeWithCache($cacheKey, function () {
            $response = $this->client->orderApi()->getAvailableFulfillmentModes();
            return $this->handleResponse($response);
        });
    }

    public function getCouponInfo(string $couponCode): array
    {
        $cacheKey = "coupon_info_{$couponCode}";

        return $this->executeWithCache($cacheKey, function () use ($couponCode) {
            $response = $this->client->orderApi()->getCouponInfo($couponCode);
            return $this->handleResponse($response);
        });
    }
}