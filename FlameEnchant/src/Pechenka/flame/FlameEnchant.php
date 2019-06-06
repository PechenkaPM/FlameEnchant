<?php

namespace Pechenka\flame;

/**
 *       ___          _                _
 *     / _ \___  ___| |__   ___ _ __ | | ____ _
 *    / /_)/ _ \/ __| '_ \ / _ \ '_ \| |/ / _` |
 *    / ___/  __/ (__| | | |  __/ | | |   < (_| |
 *    \/    \___|\___|_| |_|\___|_| |_|_|\_\__,_|
 */

use pocketmine\plugin\PluginBase;
use Pechenka\flame\events\EventListener;

/**
 * Class FlameEnchant
 * @package Pechenka\flame
 */
class FlameEnchant extends PluginBase {

    /**
     * @var FlameEnchant
     */
    private static $instance;


    public function onEnable() {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getLogger()->info("Плагин FlameEnchant был успешно включен! Автор - 3P: vk.com/vovan446");
    }

    /**
     * @return FlameEnchant
     */
    public static function getPlugin() { //ненужная функция, можете убрать ее, ошибок не будет, возможно кто-то захочет допилить зачарования и ему она пригодится.
        return self::$instance;
    }
}
