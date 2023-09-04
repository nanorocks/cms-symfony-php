<?php

namespace App\Command;

use App\DataTransferObject\Tag\TagCreateUpdateDto;
use App\Helper\DomainHelper;
use App\Repository\TagRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:sync-tags',
    description: 'Sync all tags to db! Pass --help to see your options.',
)]
class SyncTagsCommand extends Command
{

    public function __construct(protected TagRepository $tagRepository)
    {
        parent::__construct(null);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // TODO: add media for category to map

        $tags = [
            "hardcore",
            "adult",
            "nsfw",
            "xxx",
            "amateur",
            "porn",
            "twitterafterdark",
            "Sinday",
            "becauseboobies",
            "hooters",
            "boobselfie(s)",
            "bustingout",
            "buns",
            "buttselfie",
            "becausebooty",
            "becauseass",
            "assworship",
            "buttworship",
            "webcamgirl(s)",
            "curves",
            "babes",
            "girls",
            "instagirls",
            "models",
            "webcammodel(s)",
            "webcambabe(s)",
            "fetishmodels",
            "modelswanted",
            "brunette",
            "blonde",
            "redhead",
            "milf",
            "camgirl",
            "ebony",
            "cammodel(s)",
            "livecams",
            "livewebcams",
            "freecams",
            "camshows",
            "webcamshow",
            "ifriends",
            "webcamsex",
            "cam2cam",
            "adultwebcams",
            "pay2play",
            "playforpay",
            "camshow(s)",
            "freewebcams",
            "webcamshow(s)",
            "ifriends",
            "fetish",
            "bdsm",
            "footfetish",
            "findom",
            "cbt",
            "bondage",
            "latex",
            "footworship",
            "fetishes",
            "dominatrix",
            "footfetish",
            "paypig",
            "dominantfemale",
            "latexfetish",
            "ballbusting",
            "cbt",
            "bound",
            "ballgag",
            "hogtied",
            "ropebondage",
            "footworship",
            "squirt",
            "lingerie",
            "bikini",
            "pantyhose",
            "highheels",
            "stockings",
            "thong",
            "MirrorMonday",
            "TittyTuesday",
            "Humpday",
            "ThongThursday",
            "FriskyFriday",
            "FetishFriday",
            "SexySaturday",
            "Sinday",
            "tranny",
            "shemale",
            "dildo",
            "crotch",
            "ts",
            "transpinay",
            "ladyboy",
            "trans",
            "pervert",
            "pov",
        ];

        foreach ($tags as $tag) {
            $this->tagRepository->createIfNotExist(new TagCreateUpdateDto(
                $tag,
                DomainHelper::slugify($tag),
                null
            ));
        }

        $io->success('Tag domain synced!');

        return Command::SUCCESS;
    }
}
