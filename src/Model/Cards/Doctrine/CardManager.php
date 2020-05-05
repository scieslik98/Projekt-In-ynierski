<?php

namespace App\Model\Cards\Doctrine;

use App\Model\Cards\Card;
use App\Model\Cards\Interfaces\CardManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

class CardManager implements CardManagerInterface
{

    /**
     * @var EntityManagerInterface
     */
    protected $objectManager;

    /**
     * @var string
     */
    private $class;

    /**
     * Constructor.
     *
     * @param EntityManagerInterface $om
     * @param string $class
     */
    public function __construct(EntityManagerInterface $om, $class = null)
    {
        $this->objectManager = $om;
        $this->class = $class;
    }

    /**
     * @inheritDoc
     */
    public function create(): CardManagerInterface
    {
        $class = $this->getClass();
        return new $class();
    }

    /**
     * @inheritDoc
     */
    public function delete(Card $card)
    {
        $this->objectManager->remove($card);
        $this->objectManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getClass()
    {
        if (false !== strpos($this->class, ':')) {
            $metadata = $this->objectManager->getClassMetadata($this->class);
            $this->class = $metadata->getName();
        }

        return $this->class;
    }

    /**
     * @inheritDoc
     */
    public function reload(Card $card)
    {
        $this->objectManager->refresh($card);
    }

    /**
     * @inheritDoc
     */
    public function update(Card $card, $andFlush = true)
    {
        $this->objectManager->persist($card);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * @return \Doctrine\Persistence\ObjectRepository
     */
    protected function getRepository()
    {
        return $this->objectManager->getRepository($this->getClass());
    }

}