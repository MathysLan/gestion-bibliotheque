<?php

namespace App\Factory;

use App\Entity\Abonne;
use App\Repository\AbonneRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Abonne>
 *
 * @method        Abonne|Proxy create(array|callable $attributes = [])
 * @method static Abonne|Proxy createOne(array $attributes = [])
 * @method static Abonne|Proxy find(object|array|mixed $criteria)
 * @method static Abonne|Proxy findOrCreate(array $attributes)
 * @method static Abonne|Proxy first(string $sortedField = 'id')
 * @method static Abonne|Proxy last(string $sortedField = 'id')
 * @method static Abonne|Proxy random(array $attributes = [])
 * @method static Abonne|Proxy randomOrCreate(array $attributes = [])
 * @method static AbonneRepository|ProxyRepositoryDecorator repository()
 * @method static Abonne[]|Proxy[] all()
 * @method static Abonne[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Abonne[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Abonne[]|Proxy[] findBy(array $attributes)
 * @method static Abonne[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Abonne[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class AbonneFactory extends PersistentProxyObjectFactory{
    private \Transliterator $transliterator;

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        $this->transliterator = \Transliterator::create('Any-Lower; Latin-ASCII');
    }


    public static function class(): string
    {
        return Abonne::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        $lastname =self::faker()->lastName();
        $firstname = self::faker()->firstName();

        return [
            'dateInscription' => self::faker()->dateTime(),
            'email' => $this->normalizeName($firstname) . '.' .$this->normalizeName($lastname).'@'.self::faker()->domainName(),
            'livre' => null, // TODO add App\Entity\Livre type manually
            'nom' => $lastname,
            'nombreEmpruntAutorise' => self::faker()->randomNumber(),
            'prenom' => $firstname,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Abonne $abonne): void {})
        ;
    }

    protected function normalizeName(string $name): string
    {
        return preg_replace('/\W+/', '-', mb_strtolower($this->transliterator->transliterate($name)));
    }

}
