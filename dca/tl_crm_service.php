<?php


/**
 * Table tl_crm_service
 */
$GLOBALS['TL_DCA']['tl_crm_service'] = array
(
    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'onload_callback' => array(
            array('tl_crm_service', 'onloadCb')
        ),
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode' => 1,
            'fields' => array('projectDateStart'),
            'flag' => 8,
            'panelLayout' => 'filter;sort,search,limit',
            //'disableGrouping' => true,
            //'headerFields' => array('invoiceNumber', 'toCustomer', 'title'),
            'child_record_class' => 'no_padding',
        ),
        'label' => array
        (
            'fields' => array('invoiceNumber', 'toCustomer', 'title'),
            //'format' => '%s %s %s',
            'label_callback' => array('tl_crm_service', 'listServices'),

        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();"'
            ),

        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'copy' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'show' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            ),
            'generateInvoice' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['generateInvoice'],
                'href' => 'action=generateInvoice',
                'icon' => 'system/modules/markocupic_crm/assets/images/invoice_download.png'
            ),
        )
    ),

    // Palettes
    'palettes' => array
    (
        //'__selector__'              => array(''),
        'default' => '{service_legend},title,projectDateStart,toCustomer,description,servicePositions;
										{invoice_legend},invoiceType,invoiceNumber,invoiceDate,price,currency,defaultInvoiceText,alternativeInvoiceText,crmInvoiceTpl;
										{state_legend},paid'

    ),

    // Subpalettes
    'subpalettes' => array
    (//'repetition'            	=> ''
    ),

    // Fields
    'fields' => array
    (
        'id' => array(
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),

        'title' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['title'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 250, 'tl_class' => 'clr'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'projectDateStart' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['projectDateStart'],
            'default' => time(),
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('mandatory' => true, 'rgxp' => 'date', 'datepicker' => true, 'tl_class' => 'clr wizard'),
            'sql' => "varchar(10) NOT NULL default ''"
        ),

        'toCustomer' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['toCustomer'],
            'inputType' => 'select',
            'sorting' => true,
            'filter' => true,
            'search' => true,
            'exclude' => true,
            'foreignKey' => 'tl_crm_customer.company',
            'eval' => array('multiple' => false, 'tl_class' => 'clr'),
            'sql' => "blob NULL",
            'relation' => array('type' => 'belongsTo', 'load' => 'lazy')
        ),
        'description' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['description'],
            'inputType' => 'textarea',
            'exclude' => true,
            'eval' => array('decodeEntities' => false, 'tl_class' => 'clr'),
            'sql' => "mediumtext NULL"
        ),
        'servicePositions' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['servicePositions'],
            'inputType' => 'multiColumnWizard',
            'exclude' => true,
            'eval' => array(
                'columnFields' => array
                (
                    'item' => array
                    (
                        'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['position_item'],
                        'exclude' => true,
                        'inputType' => 'textarea',
                        'eval' => array('style' => 'width:95%;')
                    ),
                    'quantity' => array
                    (
                        'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['position_quantity'],
                        'exclude' => true,
                        'inputType' => 'select',
                        'options' => range(1, 50, 0.25),
                        'eval' => array('style' => 'width:50px;', 'chosen' => true)
                    ),
                    'unit' => array
                    (
                        'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['position_unit'],
                        'exclude' => true,
                        'inputType' => 'select',
                        'options' => array('h', 'Mt.', 'Stk.'),
                        'eval' => array('style' => 'width:50px;', 'chosen' => true)
                    ),
                    'price' => array
                    (
                        'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['position_price'],
                        'exclude' => true,
                        'inputType' => 'text',
                        'eval' => array('rgxp' => 'natural', 'style' => 'width:50px;text-align:center;')
                    ),
                )
            ),
            'sql' => "blob NULL"
        ),
        'price' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['price'],
            'inputType' => 'text',
            'exclude' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 12, 'tl_class' => 'clr', 'rgxp' => 'natural', 'alwaysSave' => true),
            'sql' => "double NOT NULL default '0'"
        ),

        'currency' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['currency'],
            'inputType' => 'select',
            'exclude' => true,
            'options' => array('EUR', 'CHF'),
            'eval' => array('mandatory' => true, 'chosen' => true, 'tl_class' => 'clr'),
            'sql' => "varchar(3) NOT NULL default ''"
        ),
        'invoiceType' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['invoiceType'],
            'sorting' => true,
            'filter' => true,
            'search' => true,
            'exclude' => true,
            'reference' => &$GLOBALS['TL_LANG']['tl_crm_service']['invoiceTypeReference'],
            'options' => array('calculation', 'invoiceNotDelivered', 'invoiceDelivered'),
            'inputType' => 'select',
            'eval' => array('tl_class' => 'w50 wizard'),
            'sql' => "varchar(128) NOT NULL default ''"
        ),
        'invoiceDate' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['invoiceDate'],
            'default' => time(),
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('rgxp' => 'date', 'datepicker' => true, 'tl_class' => 'clr wizard'),
            'sql' => "varchar(10) NOT NULL default ''"
        ),
        'invoiceNumber' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['invoiceNumber'],
            'default' => time(),
            'exclude' => true,
            'inputType' => 'text',
            'default' => 'XXXX-' . Date::parse('m/Y'),
            'eval' => array('tl_class' => 'clr'),
            'sql' => "varchar(128) NOT NULL default ''"
        ),
        'defaultInvoiceText' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['defaultInvoiceText'],
            'inputType' => 'textarea',
            'exclude' => true,
            'default' => 'Vielen Dank für Ihren sehr geschätzten Auftrag. Für Rückfragen stehe ich Ihnen gerne zur Verfügung.' . chr(10) . chr(10) . 'Mit besten Grüßen' . chr(10) . chr(10) . 'Marko Cupic',
            'eval' => array('decodeEntities' => false, 'tl_class' => 'clr'),
            'sql' => "mediumtext NULL"
        ),
        'alternativeInvoiceText' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['alternativeInvoiceText'],
            'inputType' => 'textarea',
            'exclude' => true,
            'eval' => array('decodeEntities' => false, 'tl_class' => 'clr'),
            'sql' => "mediumtext NULL"
        ),
        'crmInvoiceTpl' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['crmInvoiceTpl'],
            'exclude' => true,
            'inputType' => 'select',
            'options_callback' => array('tl_crm_service', 'getInvoiceTemplates'),
            'eval' => array('includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'clr'),
            'sql' => "varchar(64) NOT NULL default ''"
        ),
        'crmInvoiceTpl' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['crmInvoiceTpl'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array('filesOnly' => true, 'extensions' => 'docx', 'fieldType' => 'radio', 'mandatory' => false, 'tl_class' => 'clr'),
            'sql' => "binary(16) NULL"
        ),
        'paid' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crm_service']['paid'],
            'inputType' => 'checkbox',
            'exclude' => true,
            'filter' => true,
            'eval' => array('tl_class' => 'clr'),
            'sql' => "char(1) NOT NULL default ''"
        )
    )
);

class tl_crm_service extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
        $b = [];
        foreach ($GLOBALS['TL_DCA']['tl_crm_service']['fields'] as $k => $v)
        {
            $b[] = $k;
        }

        //die(implode(',',$b));


        if (Input::get('action') == 'generateInvoice')
        {
            \ClassLoader::addClasses(array(
                'PhpWord' => 'composer/vendor/phpoffice/phpword/src/PhpWord/PhpWord.php',
            ));

            $this->generateInvoice(Input::get('id'));
        }
    }

    public function onloadCb()
    {
        //
    }

    /**
     * Add the type of input field
     *
     * @param array $arrRow
     *
     * @return string
     */
    public function listServices($arrRow)
    {
        $date = Date::parse('Y-m-d', $arrRow['date']);
        $strService = '<div class="tl_content_left %s">
<div class="list-service-row-1">%s</div>
<div class="list-service-row-2">%s</div
><div class="list-service-row-3">%s</div>
</div>';
        if ($arrRow['invoiceType'] == 'invoiceDelivered')
        {
            $class = ' invoiceDelivered';
        }
        if ($arrRow['paid'])
        {
            $class = ' invoicePaid';
        }
        return sprintf($strService, $class, CrmCustomerModel::findByPk($arrRow['toCustomer'])->company, $arrRow['title'], $arrRow['invoiceNumber']);
    }

    public function generateInvoice($id)
    {
        // Load the invoice and customer data
        $objInvoice = $this->Database->prepare('SELECT * FROM tl_crm_service WHERE id=?')->execute($id);
        $objCustomer = $this->Database->prepare('SELECT * FROM tl_crm_customer WHERE id=?')->execute($objInvoice->toCustomer);


        // Get the template path
        $tplSRC = 'system/modules/markocupic_crm/templates/crm_invoice_template_default.docx';
        if ($objInvoice->crmInvoiceTpl != '' || Validator::isUuid($objInvoice->crmInvoiceTpl))
        {
            $objTplFile = FilesModel::findByUuid($objInvoice->crmInvoiceTpl);
            if ($objTplFile !== null)
            {
                $tplSRC = $objTplFile->path;
            }
        }

        // Instantiate the Template processor
        $templateProcessor = new PhpOffice\PhpWord\TemplateProcessorExtended(TL_ROOT . '/' . $tplSRC);


        $templateProcessor->setValue('invoiceAddress', $this->formatMultilineText($objCustomer->invoiceAddress));
        $ustNumber = $objCustomer->ustId != '' ? 'Us-tID: ' . $objCustomer->ustId : '';
        $templateProcessor->setValue('ustId', $ustNumber);
        $templateProcessor->setValue('invoiceDate', Date::parse('d.m.Y', $objInvoice->invoiceDate));
        $templateProcessor->setValue('invoiceNumber', $objInvoice->invoiceNumber);
        $templateProcessor->setValue('invoiceType', strtoupper($GLOBALS['TL_LANG']['tl_crm_service']['invoiceTypeReference'][$objInvoice->invoiceType][1]));

        // Invoice table
        $arrServices = deserialize($objInvoice->servicePositions, true);
        $templateProcessor->cloneRow('a', count($arrServices));
        $quantityTotal = 0;
        foreach ($arrServices as $key => $arrService)
        {
            $i = $key + 1;
            $quantityTotal += $arrService['quantity'];
            $templateProcessor->setValue('a#' . $i, htmlspecialchars(utf8_decode_entities($i)));
            $templateProcessor->setValue('b#' . $i, $this->formatMultilineText($arrService['item']));
            $templateProcessor->setValue('c#' . $i, $arrService['quantity']);
            $templateProcessor->setValue('d#' . $i, htmlspecialchars(utf8_decode_entities($objInvoice->currency)));
            $templateProcessor->setValue('e#' . $i, htmlspecialchars(utf8_decode_entities($arrService['price'])));
        }
        $templateProcessor->setValue('f', $quantityTotal);
        $templateProcessor->setValue('g', $objInvoice->currency);
        $templateProcessor->setValue('h', $objInvoice->price);
        // End table

        if ($objInvoice->alternativeInvoiceText != '')
        {
            $templateProcessor->setValue('INVOICE_TEXT', $this->formatMultilineText($objInvoice->alternativeInvoiceText));
        }
        else
        {
            $templateProcessor->setValue('INVOICE_TEXT', $this->formatMultilineText($objInvoice->defaultInvoiceText));
        }

        $type = $GLOBALS['TL_LANG']['tl_crm_service']['invoiceTypeReference'][$objInvoice->invoiceType][1];
        $filename = $type . '_' . Date::parse('Ymd', $objInvoice->invoiceDate) . '_' . str_replace('/', '-', $objInvoice->invoiceNumber) . '.docx';
        $templateProcessor->saveAs(TL_ROOT . '/files/Rechnungen/' . $filename);
        sleep(1);
        \Contao\Controller::sendFileToBrowser('files/Rechnungen/' . $filename);

    }

    /**
     * @param $text
     * @return mixed|string
     */
    public function formatMultilineText($text)
    {
        $text = htmlspecialchars(utf8_decode_entities($text));
        $text = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $text);
        return $text;
    }


}

