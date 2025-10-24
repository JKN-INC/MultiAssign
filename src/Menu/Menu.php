<?php

namespace srag\Plugins\MultiAssign\Menu;


use ILIAS\GlobalScreen\Scope\MainMenu\Provider\AbstractStaticMainMenuPluginProvider;
use ILIAS\UI\Component\Symbol\Icon\Standard;
use ilMultiAssignPlugin;
use ILIAS\GlobalScreen\Identification\IdentificationInterface;

use ilUIPluginRouterGUI;
use multaAccess;
use multaMainGUI;

/**
 * Class Menu
 *
 * @package srag\Plugins\MultiAssign\Menu
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class Menu extends AbstractStaticMainMenuPluginProvider
{


    const PLUGIN_CLASS_NAME = ilMultiAssignPlugin::class;

    /**
     * @inheritDoc
     */
    public function getStaticTopItems() : array
    {


         global $DIC;

        if (isset($DIC['global_screen'])) {
        
            $globalScreen = $DIC['global_screen'];
            $mainBar = $globalScreen->mainBar();
            $ui = $DIC->ui();
            
            // Function to create a unique identifier for UI elements
            $identificationInterface = function ($id) : IdentificationInterface {
                return $this->if->identifier($id);
            };

            // Creating an icon for the menu items
            $icon = $ui->factory()->symbol()->icon()->standard(
                Standard::USR,
                $this->plugin->txt("mm_top")
            );

            $item[] = $mainBar->topLinkItem($identificationInterface(ilMultiAssignPlugin::PLUGIN_ID . "_top"))
            ->withTitle(ilMultiAssignPlugin::PLUGIN_NAME)
            ->withAction($DIC->ctrl()->getLinkTargetByClass([
                ilUIPluginRouterGUI::class,
                multaMainGUI::class
            ]))
            ->withSymbol($icon)
            ->withPosition(100)
            ->withVisibilityCallable(function (): bool {
                return multaAccess::hasAccess();
                })
            ->withAvailableCallable(function (): bool {
                 return ilMultiAssignPlugin::getInstance()->isActive();
                });

            return $item;
        }
        else {
            return [];
        }
    }

    /**
     *
     * @return array
     */
    public function getStaticSubItems(): array
    {
        return [];
    }
}
