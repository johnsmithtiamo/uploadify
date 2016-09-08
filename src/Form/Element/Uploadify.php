<?php

namespace Uploadify\Form\Element;

use Zend\Form\Element\File;
use Zend\Stdlib\ArrayUtils;
use Traversable;

class Uploadify extends File {

    /**
     * The height of the button in pixels.
     * @var int
     */
    private $height = 30;

    /**
     * The width of the browse button in pixels.  Do not include ‘px’ in the value as this should only be an integer.
     * @var int
     */
    private $width = 120;

    /**
     * The path to the server-side upload script (uploadify.php).  This should be a path that is relative to the root is possible to avoid issues, but it will also accept a path that is relative to the current script.
     * @var type
     */
    private $uploader = 'uploadify.php';

    /**
     * The maximum number of files you are allowed to upload.  When this number is reached or exceeded, the onUploadError event is triggered.
     * @var int
     */
    private $uploadLimit = 1;

    /**
     * A list of allowable extensions that can be uploaded.  A manually typed in file name can bypass this level of security so you should always check file types in your server-side script.  Multiple extensions should be separated by semi-colons (i.e. ‘*.jpg; *.png; *.gif’).
     * @var string
     */
    private $fileTypeExts = '*.*';

    /**
     * The maximum size allowed for a file upload.  This value can be a number or string.  If it’s a string, it accepts a unit (B, KB, MB, or GB).  The default unit is in KB.  You can set this value to 0 for no limit.
     * @var string
     */
    private $fileSizeLimit = '3MB';

    /**
     * The method to use when submitting the file upload.  The possible values are ‘post’ or ‘get’.
     * @var string
     */
    private $method = 'post';

    /**
     * A class name to add to the Uploadify button.
     * @var type
     */
    private $buttonClass = '';

    /**
     * The text that will appear on the browse button.  This text is rendered as HTML and may include HTML entities.
     * @var string
     */
    private $buttonText = 'SELECT FILES';

    /**
     * The path to the uploadify.swf file.  This path should be relative to the root if possible to avoid issues, but will also accept paths relative to the current script.
     * @var string
     */
    private $swf = '/module/Uploadify/public/uploadify.swf';

    /**
     * Set to false if you do not want the files to automatically upload when they are added to the queue.  If set to false, the upload can be triggered using the upload method.
     * @var bool
     */
    private $auto = 'true';
    private $route;

    public function setOptions($options) {

        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        } elseif (!is_array($options)) {
            
        }
        if (isset($options['uploader'])) {
            $this->setUploader($options['uploader']);
        }

        if (isset($options['height'])) {
            $this->setHeight($options['height']);
        }
        if (isset($options['width'])) {
            $this->setWidth($options['width']);
        }

        if (isset($options['auto'])) {
            $this->setAuto($options['auto']);
        }
        if (isset($options['method'])) {
            $this->setMethod($options['method']);
        }
        if (isset($options['swf'])) {
            $this->setSwf($options['swf']);
        }

        if (isset($options['buttonClass'])) {
            $this->setButtonClass($options['buttonClass']);
        }
        if (isset($options['route'])) {
            $this->setRoute($options['route']);
        }
        if (isset($options['buttonText'])) {
            $this->setButtonText($options['buttonText']);
        }
        if (isset($options['fileTypeExts'])) {
            $this->setFileTypeExts($options['fileTypeExts']);
        }
        if (isset($options['fileSizeLimit'])) {
            $this->setFileSizeLimit($options['fileSizeLimit']);
        }
        if (isset($options['uploadLimit'])) {
            $this->setUploadLimit($options['uploadLimit']);
        }

        $this->options = $options;

        return $this;
    }

    public function getRoute() {
        return $this->route;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getUploader() {
        return $this->uploader;
    }

    public function getUploadLimit() {
        return $this->uploadLimit;
    }

    public function getFileTypeExts() {
        return $this->fileTypeExts;
    }

    public function getFileSizeLimit() {
        return $this->fileSizeLimit;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getButtonClass() {
        return $this->buttonClass;
    }

    public function getButtonText() {
        return $this->buttonText;
    }

    public function getSwf() {
        return $this->swf;
    }

    public function getAuto() {
        return $this->auto;
    }

    public function setHeight($height) {
        $this->height = $height;
        return $this;
    }

    public function setWidth($width) {
        $this->width = $width;
        return $this;
    }

    public function setUploader(type $uploader) {
        $this->uploader = $uploader;
        return $this;
    }

    public function setUploadLimit($uploadLimit) {
        $this->uploadLimit = $uploadLimit;
        return $this;
    }

    public function setFileTypeExts($fileTypeExts) {
        $this->fileTypeExts = $fileTypeExts;
        return $this;
    }

    public function setFileSizeLimit($fileSizeLimit) {
        $this->fileSizeLimit = $fileSizeLimit;
        return $this;
    }

    public function setMethod($method) {
        $this->method = $method;
        return $this;
    }

    public function setButtonClass(type $buttonClass) {
        $this->buttonClass = $buttonClass;
        return $this;
    }

    public function setButtonText($buttonText) {
        $this->buttonText = $buttonText;
        return $this;
    }

    public function setSwf($swf) {
        $this->swf = $swf;
        return $this;
    }

    public function setAuto($auto) {
        $this->auto = $auto;
        return $this;
    }

    public function setRoute($route) {
        $this->route = $route;
        return $this;
    }

}
