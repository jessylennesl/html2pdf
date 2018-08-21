<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Jessy Lenne <jessy.lenne@live.fr>
 */
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));
    $html2pdf->pdf->SetDisplayMode('fullpage');

    $content = <<<EOT
        <table border="1">
            <colgroup>
                <col><col><col>
            </colgroup>
            <thead>
                <tr>
                    <td style="padding: 1cm;">First column</td>
                    <td colspan="2" style="padding: 1cm;">Second column with a colspan of 2</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" style="padding: 1cm;">Third column with a colspan of 3</td>
                </tr>
            </tbody>
        </table>
EOT;

    $html2pdf->writeHTML($content);
    $html2pdf->output('table-colspan.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
