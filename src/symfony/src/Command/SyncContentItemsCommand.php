<?php

namespace App\Command;

use App\Entity\User;
use App\Enum\UserRoles;
use App\Helper\DomainHelper;
use App\Enum\ContentItemType;
use App\Repository\UserRepository;
use App\Repository\ContentItemRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use App\DataTransferObject\User\UserCreateUpdateDto;
use Symfony\Component\Console\Output\OutputInterface;
use App\DataTransferObject\ContentItem\ContentItemCreateUpdateDto;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[AsCommand(
    name: 'app:sync-demo-content-item',
    description: 'Sync some demo content items to db! Pass --help to see your options.',
)]
class SyncContentItemsCommand extends Command
{

    public function __construct(
        protected UserRepository $userRepository,
        protected ContentItemRepository $contentItemRepository,
        protected UserPasswordHasherInterface $userPasswordHasher,
        protected ContainerBagInterface $params
    ) {
        parent::__construct(null);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $admin = $this->userRepository->createIfNotExist(new UserCreateUpdateDto(
            'superadmin@myadmin.com',
            [UserRoles::ROLE_ADMIN->value],
            'superadmin',
            null,
            $this->userPasswordHasher->hashPassword(new User(), 'secret'),
            true
        ));

        $publicVideo = $this->params->get('init_video_content_item');

        $contentItems = [
            [
                "author" => $admin,
                "title" => "Lorem Ipsum 111",
                "slug" => "lorem-ipsum",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                "excerpt" => "Lorem ipsum dolor sit amet...",
                "type" => ContentItemType::TYPE_VIDEO,
                "published" => true,
                "published_at" => new \DateTimeImmutable('now'),
                "video_url" => $publicVideo,
            ],
            [
                "author" => $admin,
                "title" => "A Sample Blog Post 222",
                "slug" => "a-sample-blog-post",
                "content" => "This is a sample blog post content.",
                "excerpt" => "This is a sample blog post...",
                "type" => ContentItemType::TYPE_VIDEO,
                "published" => false,
                "published_at" => new \DateTimeImmutable('now'),
                "video_url" => $publicVideo,
            ],
            [
                "author" => $admin,
                "title" => "Introduction to Videos 333",
                "slug" => "introduction-to-videos",
                "content" => "In this video, we introduce the topic of videos.",
                "excerpt" => "In this video, we introduce...",
                "type" => ContentItemType::TYPE_VIDEO,
                "published" => true,
                "published_at" => new \DateTimeImmutable('now'),
                "video_url" => $publicVideo,
            ]
        ];

        foreach ($contentItems as $item) {
            $this->contentItemRepository->createIfNotExist(new ContentItemCreateUpdateDto(
                $item['title'],
                DomainHelper::slugify($item['slug']),
                $item['content'],
                $item['excerpt'],
                $item['type'],
                $item['published'],
                $item['published_at'],
                $item['author'],
                $item['video_url'],
            ));
        }

        $io->success('ContentItem domain synced!');

        return Command::SUCCESS;
    }
}
