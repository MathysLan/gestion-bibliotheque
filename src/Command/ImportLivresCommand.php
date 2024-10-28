<?php
namespace App\Command;

use App\Service\CsvImportService; // Assure-toi que le service est bien importé
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportLivresCommand extends Command
{
    protected static $defaultName = 'app:import-livres';

    private CsvImportService $csvImportService;

    public function __construct(CsvImportService $csvImportService)
    {
        parent::__construct();
        $this->csvImportService = $csvImportService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = 'var/data/isbn2.csv'; // Change ce chemin

        $this->csvImportService->importFromCsv($filePath);

        $output->writeln('Importation des livres terminée.');

        return Command::SUCCESS;
    }
}
