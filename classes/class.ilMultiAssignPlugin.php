<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once('./Services/UIComponent/classes/class.ilUserInterfaceHookPlugin.php');
require_once __DIR__ . "/Assignment/class.multaAssignment.php";
require_once __DIR__ . "/Config/class.multaConfig.php";

use ILIAS\GlobalScreen\Scope\MainMenu\Provider\AbstractStaticPluginMainMenuProvider;

/**
 * ilMultiAssignPlugin
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @version $Id$
 *
 */
class ilMultiAssignPlugin extends ilUserInterfaceHookPlugin {
    
	const PLUGIN_ID = 'multa';
	const PLUGIN_NAME = 'MultiAssign';
	/**
	 * @var ilMultiAssignPlugin
	 */
	protected static $instance;


	/**
	 * @return ilMultiAssignPlugin
	 */
	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * @var ilDBInterface
	 */
	protected ilDBInterface $db;


public function __construct()
	{
		global $DIC;

		$this->DIC = $DIC;
		$this->db = $DIC->database();
		$this->rbacreview = $DIC['rbacreview'];
		$this->component_repository = $DIC["component.repository"];

		parent::__construct($this->db, $this->component_repository, ilMultiAssignPlugin::PLUGIN_ID);


	}


	/**
	 * @return string
	 */
	public function getPluginName():string {
		return self::PLUGIN_NAME;
	}


	//	public function txt($a_var) {
	//		require_once('./Customizing/global/plugins/Libraries/PluginTranslator/class.sragPluginTranslator.php');
	//
	//		return sragPluginTranslator::getInstance($this)->active()->write()->txt($a_var);
	//	}

	/**
	 * @return bool
	 */
	protected function beforeUninstall(): bool {
		$this->db->dropTable(multaAssignment::TABLE_NAME, false);
		$this->db->dropTable(multaConfig::TABLE_NAME, false);

		return true;
	}

    /**
     * @inheritDoc
     */
    public function promoteGlobalScreenProvider() : AbstractStaticPluginMainMenuProvider {
        return new Menu(self::dic()->dic(), $this);
    }
}
