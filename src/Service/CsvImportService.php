<?php

namespace App\Service;

use League\Csv\Reader;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Livre;
use App\Entity\Genre;

class CsvImportService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function importFromCsv(string $filePath): void
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // Si le fichier a une en-tête

        foreach ($csv as $record) {
            $this->processRecord($record);
        }
    }

    private function processRecord(array $record): void
    {
        // Mapper les champs du CSV aux entités
        var_dump($record);
        $livre = new Livre();
        $livre->setIsbn($record['isbn10']);
        $livre->setTitre($record['titre']);
        $livre->setNombrePages(random_int(1,150));
        $livre->setAuteur($record['auteur']);

        // Persister les entités
        $this->em->persist($livre);
        $this->em->flush();
    }
}

