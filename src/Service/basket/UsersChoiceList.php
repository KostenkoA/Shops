<?php

namespace App\Service\basket;


interface UsersChoiceList
{
    /**
     * usersChoiceList is the interface that should be implemented by classes who want to participate
     * in the generates users list choice
     *
     * @param array $userPurchases
     * @return array
     */
    public function usersChoiceList(array $userPurchases): array;
}