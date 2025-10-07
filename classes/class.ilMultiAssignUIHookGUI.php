<?php

/* Copyright (c) 1998-2010 ILIAS open source, Extended GPL, see docs/LICENSE */
require_once('./Services/UIComponent/classes/class.ilUIHookPluginGUI.php');
require_once('./Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/MultiAssign/classes/Config/class.multaConfig.php');
require_once('./Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/MultiAssign/classes/Block/class.multaPDBlock.php');
require_once('./Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/MultiAssign/classes/class.multaAccess.php');

/**
 * Class ilMultiAssignUIHookGUI
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @version $Id$
 * @ingroup ServicesUIComponent
 * 
 * @ilCtrl_IsCalledBy ilMultiAssignUIHookGUI: ilRouterGUI, ilUIPluginRouterGUI, ilPCPluggedGUI, ilRepositoryGUI, ilTabsGUI, PageContentGUI
 */
class ilMultiAssignUIHookGUI extends ilUIHookPluginGUI {

	/**
	 * Get html for a user interface area
	 *
	 * @param string $a_comp
	 * @param string $a_part
	 * @param array  $a_par
	 *
	 * @internal param $
	 * @return array
	 */
	public function getHTML(string $a_comp, string $a_part, array $a_par = []): array {

		if (multaConfig::getValueById(multaConfig::F_SHOW_PD_BUTTON) && multaAccess::hasAccess()) {

			if (($a_comp == 'Services/PersonalDesktop' || $a_comp == 'Services/Dashboard') AND $a_part == 'right_column') {
				global $ilCtrl;
				$cmd_class = $ilCtrl->getCmdClass();

				// Likely need to be ildashboardgui included
				if (in_array($cmd_class, ['ilUIPluginRouterGUI', 'multaMainGUI', 'ildashboardgui'])) {
					return array(
						'mode' => ilUIHookPluginGUI::PREPEND,
						'html' => $this->getBlockHTML()
					);
				}
			}
		}

		return array( 'mode' => ilUIHookPluginGUI::KEEP, 'html' => '' );
	}


	/**
	 * @return string
	 */
	protected function getBlockHTML() {
		$block = new multaPDBlock();

		return $block->getHTML();
	}
}
