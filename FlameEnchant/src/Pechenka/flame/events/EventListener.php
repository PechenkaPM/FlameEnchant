<?php

namespace Pechenka\flame\events;

/**
 *       ___          _                _
 *     / _ \___  ___| |__   ___ _ __ | | ____ _
 *    / /_)/ _ \/ __| '_ \ / _ \ '_ \| |/ / _` |
 *    / ___/  __/ (__| | | |  __/ | | |   < (_| |
 *    \/    \___|\___|_| |_|\___|_| |_|_|\_\__,_|
 */

use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\item\Enchantment;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityShootBowEvent;
use Pechenka\flame\FlameEnchant;

/**
 * Class EventListener
 * @package Pechenka\flame\events
 */
class EventListener implements Listener {

    /**
     * @var FlameEnchant
     */
    private static $instance;

    /**
     * EventListener constructor.
     * @param FlameEnchant $plugin
     */
    public function __construct(FlameEnchant $plugin) {
        self::$instance = $plugin;
    }

    /**
     * @return FlameEnchant
     */
    public static function getPlugin() { //ненужная функция, можете убрать ее, ошибок не будет, возможно кто-то захочет допилить зачарования и ему она пригодится.
        return self::$instance;
    }

    /**
     * @param EntityDamageEvent $event
     * @ignoreCancelled true
     */
    public function swordFlame(EntityDamageEvent $event) {
        $player = $event->getEntity();
        if ($player instanceof Player) {
            if ($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                if ($damager instanceof Player) {
                    $item = $damager->getInventory()->getItemInHand();
                    if ($item->hasEnchantment(Enchantment::FIRE_ASPECT)) {    
                        $player->setOnFire(4 * $item->getEnchantment(Enchantment::FIRE_ASPECT)->getLevel()); //minecraft wiki
                    }
                }
            }
        }
    }

    /**
     * @param EntityShootBowEvent $event
     * @ignoreCancelled true
     */
    public function bowFlame(EntityShootBowEvent $event) {
        $entity = $event->getProjectile();
        if (($bow = $event->getBow()) !== null && $bow->hasEnchantment(Enchantment::FLAME)) { 
            $entity->setOnFire(777);
        }
    }
}
