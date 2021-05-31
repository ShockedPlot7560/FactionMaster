<?php

/*
 *
 *      ______           __  _                __  ___           __
 *     / ____/___ ______/ /_(_)___  ____     /  |/  /___ ______/ /____  _____
 *    / /_  / __ `/ ___/ __/ / __ \/ __ \   / /|_/ / __ `/ ___/ __/ _ \/ ___/
 *   / __/ / /_/ / /__/ /_/ / /_/ / / / /  / /  / / /_/ (__  ) /_/  __/ /  
 *  /_/    \__,_/\___/\__/_/\____/_/ /_/  /_/  /_/\__,_/____/\__/\___/_/ 
 *
 * FactionMaster - A Faction plugin for PocketMine-MP
 * This file is part of FactionMaster
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @author ShockedPlot7560 
 * @link https://github.com/ShockedPlot7560
 * 
 *
*/

namespace ShockedPlot7560\FactionMaster\Reward;

use onebone\economyapi\EconomyAPI;
use ShockedPlot7560\FactionMaster\Main;

class RewardFactory {

    private static $list;

    public static function init() {

        if (Main::getInstance()->EconomyAPI instanceof EconomyAPI) {
            self::registerReward(new Money());
        }
        self::registerReward(new Power());
        self::registerReward(new MemberLimit());
        self::registerReward(new HomeLimit());
        self::registerReward(new ClaimLimit());
        self::registerReward(new AllyLimit());
        
    }

    /**
     * Use to register or overwrite a new Reward
     * @param Reward $reward A class implements the RewardInterface
     * @param boolean $override (Default: false) If it's set to true and the slug are already use, it will be overwrite
     */
    public static function registerReward(RewardInterface $reward, bool $override = false) : void {
        $type = $reward->getType();
        if (self::isRegistered($type) && $override === false) return;
        self::$list[$type] = $reward;
    }

    public static function get(string $type) : ?RewardInterface {
        return self::$list[$type] ?? null;
    }

    public static function isRegistered(string $type) : bool {
        return isset(self::$list[$type]);
    }

    public static function getAll() : array {
        return self::$list;
    }

}