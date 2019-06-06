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
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityShootBowEvent;
use Pechenka\flame\FlameEnchant;

/**
 * Class EventListener
 * @package Pechenka\flame\events
 */
class EventListener implements Listener
{

    /**
     * @var FlameEnchant
     */
    private static $instance;

    /**
     * EventListener constructor.
     * @param FlameEnchant $plugin
     */
    public function __construct(FlameEnchant $plugin)
    {
        self::$instance = $plugin;
    }

    /**
     * @return FlameEnchant
     */
    private static function getPlugin() //ненужная функция, можете убрать ее, ошибок не будет, возможно кто-то захочет допилить зачарования и ему она пригодится.
    {
        return self::$instance;
    }

    /**
     * @param EntityDamageEvent $event
     * @ignoreCancelled false
     */
    public function swordFlame(EntityDamageEvent $event)
    {
        $player = $event->getEntity();
        if ($player instanceof Player) {
            if ($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                if ($damager instanceof Player) {
                    $item = $damager->getInventory()->getItemInHand();
                    if ($item->hasEnchantment(13)) {    //Fire Aspect
                        $player->setOnFire(3);
                    }
                }
            }
        }
    }

    /**
     * @param EntityShootBowEvent $event
     * @ignoreCancelled false
     */
    public function bowFlame(EntityShootBowEvent $event)
    {
        $entity = $event->getProjectile();
        if (!is_null(($bow = $event->getBow())) && $bow->hasEnchantment(21)) {  //Flame
            $entity->setOnFire(777);
        }
    }
}