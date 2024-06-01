<?php

declare(strict_types=1);

namespace MultipleChain\Boilerplate\Assets;

use MultipleChain\Boilerplate\Provider;
use MultipleChain\Interfaces\Assets\CoinInterface;
use MultipleChain\Interfaces\Services\ProviderInterface;
use MultipleChain\Boilerplate\Services\TransactionSigner;

class Coin implements CoinInterface
{
    /**
     * @var Provider
     */
    private Provider $provider;

    /**
     * @param Provider|null $provider
     */
    public function __construct(?ProviderInterface $provider = null)
    {
        $this->provider = $provider ?? Provider::instance();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Coin';
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return 'COIN';
    }

    /**
     * @return int
     */
    public function getDecimals(): int
    {
        return 18;
    }

    /**
     * @param string $owner
     * @return float
     */
    public function getBalance(string $owner): float
    {
        $this->provider->isTestnet(); // just for phpstan
        return 0.0;
    }

    /**
     * @param string $sender
     * @param string $receiver
     * @param float $amount
     * @return TransactionSigner
     */
    public function transfer(string $sender, string $receiver, float $amount): TransactionSigner
    {
        return new TransactionSigner('example');
    }
}
