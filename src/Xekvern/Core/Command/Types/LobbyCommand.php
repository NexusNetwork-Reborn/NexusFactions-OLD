<?php

declare(strict_types=1);

namespace Xekvern\Core\Command\Types;

use Xekvern\Core\Player\NexusPlayer;
use Xekvern\Core\Translation\Translation;
use Xekvern\Core\Translation\TranslatonException;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class LobbyCommand extends Command {

    /**
     * LobbyCommand constructor.
     */
    public function __construct() {
        parent::__construct("lobby", "Teleport to lobby.", null, ["hub"]);
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslatonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof NexusPlayer) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        $sender->transfer("hub.nexuspe.net", 19132);
    }
}