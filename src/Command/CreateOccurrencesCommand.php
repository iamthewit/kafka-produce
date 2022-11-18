<?php


namespace App\Command;

use App\Event\Occurrence;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class CreateOccurrencesCommand
 * @package App\Command
 */
#[AsCommand(name: 'event:occurrence')]
class CreateOccurrencesCommand extends Command
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
//        for ($i = 0; $i < 10; $i++) {
            $this->bus->dispatch(new Occurrence(time()));
//        }
        return Command::SUCCESS;
    }
}