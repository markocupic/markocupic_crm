<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Models
	'Contao\CrmCustomerModel' => 'system/modules/markocupic_crm/models/CrmCustomerModel.php',
	'Contao\CrmServiceModel'  => 'system/modules/markocupic_crm/models/CrmServiceModel.php',
));
