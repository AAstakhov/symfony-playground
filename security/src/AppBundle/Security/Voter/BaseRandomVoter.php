<?php


namespace AppBundle\Security\Voter;

use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

abstract class BaseRandomVoter extends Voter
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    protected function supports($attribute, $subject)
    {
        return 'show-random-access-page' === $attribute;
    }

    /**
     * @inheritdoc
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $randomFactor = rand(0, 1);

        $votedToEnableAccess = ($randomFactor === 1);

        $this->logger->info(static::class . ' decision is ' . (int)$votedToEnableAccess);

        return $votedToEnableAccess;
    }
}