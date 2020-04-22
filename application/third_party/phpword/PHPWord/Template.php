<?php

/**
 * PHPWord
 *
 * Copyright (c) 2010 PHPWord
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPWord
 * @package    PHPWord
 * @copyright  Copyright (c) 010 PHPWord
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    Beta 0.6.2, 24.07.2010
 */

/**
 * PHPWord_DocumentProperties
 *
 * @category   PHPWord
 * @package    PHPWord
 * @copyright  Copyright (c) 2009 - 2010 PHPWord (http://www.codeplex.com/PHPWord)
 */
class PHPWord_Template {
    private $_objZip;
    private $_tempFileName;
    private $_documentXML;
    private $_header1XML;
    private $_footer1XML;
    private $_rels;
    private $_types;
    private $_countRels;

    /**
     * Create a new Template Object
     * @param string $strFilename
     */
    public function __construct($strFilename) {
        $path = dirname($strFilename);

        $this->_tempFileName = $path . DIRECTORY_SEPARATOR . time() . '.docx'; // $path doesn't include the trailing slash - Custom code by Matt Bowden (blenderstyle) 04/12/2011

        copy($strFilename, $this->_tempFileName); // Copy the source File to the temp File

        $this->_objZip = new ZipArchive();
        $this->_objZip->open($this->_tempFileName);

        $this->_documentXML = $this->_objZip->getFromName('word/document.xml');
        $this->_header1XML  = $this->_objZip->getFromName('word/header1.xml'); // Custom code by Matt Bowden (blenderstyle) 04/12/2011
        $this->_footer1XML  = $this->_objZip->getFromName('word/footer1.xml'); // Custom code by Matt Bowden (blenderstyle) 04/12/2011
        $this->_rels        = $this->_objZip->getFromName('word/_rels/document.xml.rels'); #erap 07/07/2015
        $this->_types       = $this->_objZip->getFromName('[Content_Types].xml'); #erap 07/07/2015
        $this->_countRels   = substr_count($this->_rels, 'Relationship') - 1; #erap 07/07/2015
    }

    /**
     * Set a Template value
     * @param mixed $search
     * @param mixed $replace
     */
    public function setValue($search, $replace) {
        $search = '${' . $search . '}';
        $replace = $this->limpiarString($replace);
        $this->_documentXML = str_replace($search, $replace, $this->_documentXML);
        $this->_header1XML = str_replace($search, $replace, $this->_header1XML); // Custom code by Matt Bowden (blenderstyle) 04/12/2011
        $this->_footer1XML = str_replace($search, $replace, $this->_footer1XML); // Custom code by Matt Bowden (blenderstyle) 04/12/2011
    }

    /**
     * Save Template
     * @param string $strFilename
     */
    public function save($strFilename) {
        if (file_exists($strFilename))
            unlink($strFilename);
        $this->_objZip->addFromString('word/document.xml', $this->_documentXML);
        $this->_objZip->addFromString('word/header1.xml', $this->_header1XML); // Custom code by Matt Bowden (blenderstyle) 04/12/2011
        $this->_objZip->addFromString('word/footer1.xml', $this->_footer1XML); // Custom code by Matt Bowden (blenderstyle) 04/12/2011
        $this->_objZip->addFromString('word/_rels/document.xml.rels', $this->_rels); #erap 07/07/2015
        $this->_objZip->addFromString('[Content_Types].xml', $this->_types); #erap 07/07/2015
        // Close zip file
        if ($this->_objZip->close() === false)
            throw new Exception('Could not close zip file.');

        rename($this->_tempFileName, $strFilename);
    }

    public function replaceImage($path, $imageName) {
        $this->_objZip->deleteName('word/media/' . $imageName);
        $this->_objZip->addFile($path, 'word/media/' . $imageName);
    }

    public function replaceStrToImg( $strKey, $arrImgPath ){
        //289x108
        $strKey = '${'.$strKey.'}';
        $relationTmpl = '<Relationship Id="RID" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/IMG"/>';
        $imgTmpl = '<w:pict><v:shape type="#_x0000_t75" style="width:WIDpx;height:HEIpx"><v:imagedata r:id="RID" o:title=""/></v:shape></w:pict>';
        $typeTmpl = ' <Override PartName="/word/media/IMG" ContentType="image/EXT"/>';
        $toAdd = $toAddImg = $toAddType = '';
        $aSearch = array('RID', 'IMG');
        $aSearchType = array('IMG', 'EXT');

        foreach($arrImgPath as $img){
            $ex_img = explode('.', $img['img']);
            $imgExt = array_pop( $ex_img );
            if( in_array($imgExt, array('jpg', 'JPG') ) )
                $imgExt = 'jpeg';
            $imgName = 'img' . $this->_countRels . '.' . $imgExt;
            $rid = 'rId' . $this->_countRels++;

            $this->_objZip->addFile($img['img'], 'word/media/' . $imgName);

            if( isset($img['size']) ){
                $w = $img['size'][0];
                $h = $img['size'][1];
            }
            else{
                $w = 289;
                $h = 108;
            }

            $toAddImg .= str_replace(array('RID', 'WID', 'HEI'), array($rid, $w, $h), $imgTmpl) ;
            if( isset($img['dataImg']) )
                $toAddImg .= '<w:br/><w:t>' . $this->limpiarString($img['dataImg']) . '</w:t><w:br/>';

            $aReplace = array($imgName, $imgExt);
            $toAddType .= str_replace($aSearchType, $aReplace, $typeTmpl) ;

            $aReplace = array($rid, $imgName);
            $toAdd .= str_replace($aSearch, $aReplace, $relationTmpl);
        }

        $this->_documentXML = str_replace('<w:t>' . $strKey . '</w:t>', $toAddImg, $this->_documentXML);
        $this->_types       = str_replace('</Types>', $toAddType, $this->_types) . '</Types>';
        $this->_rels        = str_replace('</Relationships>', $toAdd, $this->_rels) . '</Relationships>';
    }

    function limpiarString($str) {
        return str_replace(
                array('&', '<', '>', "\n"),
                array('&amp;', '&lt;', '&gt;', "\n" . '<w:br/>'),
                $str
        );
    }

}

?>
