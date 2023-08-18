<?php

namespace App\Command;

use App\Repository\VehicleModelRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:test',
    description: 'Add a short description for your command',
)]
class TestCommand extends Command
{
    public function __construct(
        private readonly VehicleModelRepository $vehicleModelRepository,
        string $name = null,
    )
    {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $vehicleModel = $this->vehicleModelRepository->find(1);

//        $brandName = $vehicleModel->getManufacturer()?->getBrandName();

//        if (!$brandName) {
//            $io->error('Manufacturer brandName should not be empty.');
//        }

        $tempData = $vehicleModel->getManufacturer()?->getTempData();

        if (!$tempData) {
            $io->error('Manufacturer tempData should not be empty.');
        } else {
            $io->success(sprintf('Manufacturer tempData: %s', $tempData));
        }

        return Command::SUCCESS;
    }
}
