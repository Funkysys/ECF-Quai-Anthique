<?php
// api/src/Doctrine/CurrentUserExtension.php

namespace App\Doctrine;

use Doctrine\ORM\QueryBuilder;
use App\Entity\UserOwnedInterface;
use ApiPlatform\Metadata\Operation;
use Symfony\Bundle\SecurityBundle\Security;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use App\Entity\User;

final class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        $this->addWhere($resourceClass, $queryBuilder);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, Operation $operation = null, array $context = []): void
    {
        $this->addWhere($resourceClass, $queryBuilder);
    }

    private function addWhere(string $resourceClass, QueryBuilder $queryBuilder)
    {
        
        $reflectionClass = new \ReflectionClass($resourceClass);
        if ($reflectionClass->implementsInterface(UserOwnedInterface::class) ) {
            $alias = $queryBuilder->getRootAliases()[0];
            $user =  $this->security->getUser();
            if ($user) {
                $queryBuilder
                    ->andWhere("$alias.user = :current_user")
                    ->setParameter('current_user', $this->security->getUser()->getId());
            } else {
                $queryBuilder->andWhere("$alias.user IS NULL");
            }
        } else if ($resourceClass === User::class && $this->security->isGranted("ROLE_USER") && $this->security->getUser()->getId()) {
            $alias = $queryBuilder->getRootAliases()[0];
            // dd($this->security->getUser());    
            $queryBuilder
                    ->andWhere("$alias = :current_user")
                    ->setParameter('current_user', $this->security->getUser()->getId());
        }
    }
}