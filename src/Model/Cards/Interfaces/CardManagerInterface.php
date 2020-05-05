<?php

namespace App\Model\Cards\Interfaces;

use App\Model\Cards\Card;

interface CardManagerInterface
{

    /**
     * Creates an empty card instance.
     *
     * @return CardManagerInterface
     */
    public function create(): CardManagerInterface;

    /**
     * Deletes a card.
     *
     * @param Card $card
     */
    public function delete(Card $card);

    /**
     * Returns the card's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Reloads a card.
     *
     * @param Card $card
     */
    public function reload(Card $card);

    /**
     * Updates a card.
     *
     * @param Card $card
     */
    public function update(Card $card);


}