<?php

/**
 * This code was written durring Sylius workshop
 */

namespace Acme\SyliusExamplePlugin\Service;

use Acme\SyliusExamplePlugin\Entity\Order;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;

final class UnwrapService implements UnwrapServiceInterface
{


    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ObjectManager $objectManager
    )
    {
        $this->orderRepository = $orderRepository;
        $this->objectManager = $objectManager;
    }

    public function unwrap(int $id): void
    {
        /** @var Order $order */
        $order = $this->orderRepository->find($id);

        if ($order == null) {
            throw new \InvalidArgumentException('No order found');
        }

        $order->setGiftWrapped(false);

        $this->objectManager->flush();
    }


}