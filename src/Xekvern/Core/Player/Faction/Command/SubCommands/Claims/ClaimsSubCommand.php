<?php

declare(strict_types = 1);

namespace Xekvern\Core\Player\Faction\Command\SubCommands\Claims;

use Xekvern\Core\Player\NexusPlayer;
use Xekvern\Core\Translation\Translation;
use Xekvern\Core\Translation\TranslatonException;
use Xekvern\Core\Command\Utils\SubCommand;
use Xekvern\Core\Faction\Command\Forms\ClaimsForm;
use pocketmine\command\CommandSender;
use Xekvern\Core\Player\Faction\Modules\PermissionsModule;

class ClaimsSubCommand extends SubCommand
{

    /**
     * ClaimsSubCommand constructor.
     */
    public function __construct()
    {
        parent::__construct("claims", "/faction claims");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslatonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$sender instanceof NexusPlayer) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if (!$sender->isLoaded()) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        $senderFaction = $sender->getDataSession()->getFaction();
        if ($senderFaction === null) {
            $sender->sendMessage(Translation::getMessage("beInFaction"));
            return;
        }
        if (!$senderFaction->getPermissionsModule()->hasPermission($sender, PermissionsModule::PERMISSION_CLAIM)) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        $sender->sendForm(new ClaimsForm($senderFaction));
    }
}