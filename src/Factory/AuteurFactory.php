<?php

namespace App\Factory;

use App\Entity\Auteur;
use App\Repository\AuteurRepository;
use Doctrine\ORM\EntityRepository;
use Transliterator;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Auteur>
 *
 * @method        Auteur|Proxy create(array|callable $attributes = [])
 * @method static Auteur|Proxy createOne(array $attributes = [])
 * @method static Auteur|Proxy find(object|array|mixed $criteria)
 * @method static Auteur|Proxy findOrCreate(array $attributes)
 * @method static Auteur|Proxy first(string $sortedField = 'id')
 * @method static Auteur|Proxy last(string $sortedField = 'id')
 * @method static Auteur|Proxy random(array $attributes = [])
 * @method static Auteur|Proxy randomOrCreate(array $attributes = [])
 * @method static AuteurRepository|ProxyRepositoryDecorator repository()
 * @method static Auteur[]|Proxy[] all()
 * @method static Auteur[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Auteur[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Auteur[]|Proxy[] findBy(array $attributes)
 * @method static Auteur[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Auteur[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class AuteurFactory extends PersistentProxyObjectFactory{
    private Transliterator $transliterator;

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        $this->transliterator = Transliterator::create('Any-Lower; Latin-ASCII');
    }

    public static function class(): string
    {
        return Auteur::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'nom' => self::faker()->text(100),
            'prenom' => self::faker()->text(100),
            'date_naissance' => self::faker()->date(),
            'nationalite' => self::faker()->country(),
            'biographie' => self::faker()->text()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Auteur $auteur): void {})
        ;
    }

    protected function normalizeName(string $name): string
    {
        return preg_replace('/\W+/', '-', mb_strtolower(($this->transliterator->transliterate($name))));
    }
}
