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

namespace ShockedPlot7560\FactionMaster\Button\Collection;

use onebone\economyapi\EconomyAPI;
use ShockedPlot7560\FactionMaster\Button\Button;
use ShockedPlot7560\FactionMaster\Button\ButtonCollection;
use ShockedPlot7560\FactionMaster\Button\Buttons\MainPanel\ChangeLanguage;
use ShockedPlot7560\FactionMaster\Button\Buttons\MainPanel\Faction\ManageFaction;
use ShockedPlot7560\FactionMaster\Button\Buttons\MainPanel\Faction\ManageMembers;
use ShockedPlot7560\FactionMaster\Button\Buttons\MainPanel\Faction\ViewHomes;
use ShockedPlot7560\FactionMaster\Button\Buttons\MainPanel\Faction\ViewMembers;
use ShockedPlot7560\FactionMaster\Button\Buttons\MainPanel\FactionsTop;
use ShockedPlot7560\FactionMaster\Button\Buttons\MainPanel\LeaveDelete;
use ShockedPlot7560\FactionMaster\Button\Buttons\MainPanel\Quit;
use ShockedPlot7560\FactionMaster\Main;
use ShockedPlot7560\FactionMaster\Route\Faction\BankMain;
use ShockedPlot7560\FactionMaster\Router\RouterFactory;
use ShockedPlot7560\FactionMaster\Utils\Ids;
use ShockedPlot7560\FactionMaster\Utils\Utils;

class MainCollectionFac extends ButtonCollection {

    const SLUG = "mainFac";

    public function __construct()
    {
        parent::__construct(self::SLUG);

        $this->register(new ViewMembers());

        $this->register(new ViewHomes());

        if (Main::getInstance()->EconomyAPI instanceof EconomyAPI) {
            $this->register(new Button(
                "bank", 
                function($Player) {
                    return Utils::getText($Player, "BUTTON_VIEW_BANK");
                },
                function($Player) {
                    Utils::processMenu(RouterFactory::get(BankMain::SLUG), $Player);
                }, 
                [
                    Ids::PERMISSION_BANK_DEPOSIT,
                    Ids::PERMISSION_SEE_BANK_HISTORY
                ]
            ));
        }
        
        $this->register(new ManageMembers());

        $this->register(new ManageFaction());

        $this->register(new FactionsTop());

        $this->register(new ChangeLanguage());

        $this->register(new LeaveDelete());

        $this->register(new Quit());
    }
}