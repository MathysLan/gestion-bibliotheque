<?php

namespace App\Factory;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityRepository;
use Transliterator;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Livre>
 *
 * @method        Livre|Proxy create(array|callable $attributes = [])
 * @method static Livre|Proxy createOne(array $attributes = [])
 * @method static Livre|Proxy find(object|array|mixed $criteria)
 * @method static Livre|Proxy findOrCreate(array $attributes)
 * @method static Livre|Proxy first(string $sortedField = 'id')
 * @method static Livre|Proxy last(string $sortedField = 'id')
 * @method static Livre|Proxy random(array $attributes = [])
 * @method static Livre|Proxy randomOrCreate(array $attributes = [])
 * @method static LivreRepository|ProxyRepositoryDecorator repository()
 * @method static Livre[]|Proxy[] all()
 * @method static Livre[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Livre[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Livre[]|Proxy[] findBy(array $attributes)
 * @method static Livre[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Livre[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class LivreFactory extends PersistentProxyObjectFactory{
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
        return Livre::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'auteur' => AuteurFactory::new(),
            'datePublication' => self::faker()->dateTime(),
            'isbn' => self::faker()->text(255),
            'nombrePages' => self::faker()->randomNumber(),
            'titre' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Livre $livre): void {})
        ;
    }

    protected function normalizeName(string $name): string
    {
        return preg_replace('/\W+/', '-', mb_strtolower(($this->transliterator->transliterate($name))));
    }
}
