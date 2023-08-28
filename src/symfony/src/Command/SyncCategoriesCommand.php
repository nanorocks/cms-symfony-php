<?php

namespace App\Command;

use App\DataTransferObject\Category\CreateUpdateCategoryDto;
use App\Helper\CategoryHelper;
use App\Repository\CategoryRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:sync-categories',
    description: 'Sync all categories to db! Pass --help to see your options.',
)]
class SyncCategoriesCommand extends Command
{

    public function __construct(protected CategoryRepository $categoryRepository)
    {
       parent::__construct(null);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // TODO: add media for category to map

        $categories = [
            'Anal',
            'Big ass', 
            'Big dick', 
            'Big tits', 
            'Blonde', 
            'Blowjob', 
            'Bondage', 
            'Bukkake', 
            'Compilation', 
            'Creampie', 
            'Cumshot', 
            'Double penetration', 
            'Fingering', 
            'Handjob', 
            'Hardcore', 
            'Masturbation', 
            'Orgy',
            'Public',
            'Roleplay',
            'Vintage'
        ];

        foreach ($categories as $category)
        {
            $this->categoryRepository->createIfNotExist(new CreateUpdateCategoryDto(
                $category,
                null,
                CategoryHelper::slugify($category),
                null,
                null
            ));
        }

        $io->success('Category domain synced!');

        return Command::SUCCESS;
    }
}
