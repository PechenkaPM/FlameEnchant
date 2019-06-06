<?php

namespace Pechenka\flame;

/**
 *       ___          _                _
 *     / _ \___  ___| |__   ___ _ __ | | ____ _
 *    / /_)/ _ \/ __| '_ \ / _ \ '_ \| |/ / _` |
 *    / ___/  __/ (__| | | |  __/ | | |   < (_| |
 *    \/    \___|\___|_| |_|\___|_| |_|_|\_\__,_|
 */

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityShootBowEvent;
use pocketmine\event\Listener;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class FlameEnchant extends PluginBase implements Listener{

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Плагин FlameEnchant был успешно включен! Автор - 3P: vk.com/vovan446");
    }

    /**
     * @param EntityDamageEvent $event
     */
    public function swordFlame(EntityDamageEvent $event) {
        $player = $event->getEntity();
        if ($player instanceof Player) {
            if ($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                if ($damager instanceof Player) {
                    $item = $damager->getInventory()->getItemInHand();
                    if ($item->hasEnchantment(Enchantment::FIRE_ASPECT)) {
                        //зачар добавляет по 4 секунды горения на каждом уровне (minecraft wiki)
                        $player->setOnFire(4 * $item->getEnchantment(Enchantment::FIRE_ASPECT)->getLevel());
                    }
                }
            }
        }
    }

    /**
     * @param EntityShootBowEvent $event
     */
    public function bowFlame(EntityShootBowEvent $event) {
        $entity = $event->getProjectile();
        if (($bow = $event->getBow()) !== null && $bow->hasEnchantment(Enchantment::FLAME)) {
            $entity->setOnFire(777);
        }
    }
}
