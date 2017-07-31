<?php
/**
 * @copyright  Marko Cupic 2017 <m.cupic@gmx.ch>
 * @author     Marko Cupic
 * @package    markocupic_crm
 * @license    LGPL-3.0+
 * @see	       https://github.com/markocupic/markocupic_crm
 *
 */
namespace Markocupic\MarkocupicCrm\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * Plugin for the Contao Manager.
 *
 * @author Marko Cupic
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create('Markocupic\MarkocupicCrm\MarkocupicMarkocupicCrm')
                ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle'])
                ->setReplace(['markocupic_crm']),
        ];
    }
}