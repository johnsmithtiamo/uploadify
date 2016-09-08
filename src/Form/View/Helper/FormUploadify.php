<?php

namespace Uploadify\Form\View\Helper;

use Zend\Form\View\Helper\FormFile;
use Zend\Form\ElementInterface;

class FormUploadify extends FormFile {

    private $uploadifyIsLoaded = false;
    private $csrf;

    public function setCsrfElement(ElementInterface $csrf) {
        $this->csrf = $csrf;
    }

    /**
     *
     * @return \Zend\Form\Element\Csrf
     */
    public function getCsrf() {
        return $this->csrf;
    }

    public function render(ElementInterface $element) {
        $name = $element->getName();
        if ($name === null || $name === '') {
            throw new \DomainException(sprintf(
                    '%s requires that the element has an assigned name; none discovered', __METHOD__
            ));
        }

        $attributes = $element->getAttributes();
        if (!isset($attributes['id'])) {
            $attributes['id'] = $name;
        }
        $id = $attributes['id'];
        $attributes['type'] = $this->getType($element);
        $attributes['name'] = $name;
        if (array_key_exists('multiple', $attributes) && $attributes['multiple']) {
            $attributes['name'] .= '[]';
        }

        $value = $element->getValue();
        if (is_array($value) && isset($value['name']) && !is_array($value['name'])) {
            $attributes['value'] = $value['name'];
        } elseif (is_string($value)) {
            $attributes['value'] = $value;
        }
        $html = $this->loadUploadifyScript();
        $html .= sprintf(
                '<input %s%s', $this->createAttributesString($attributes), $this->getInlineClosingBracket()
        );
        $csrf = $this->getCsrf();
        $formData = '';
        if ($csrf) {
            $csrfName = $csrf->getName();
            $csrfValue = $csrf->getValue();
            $formData = "formData: {{$csrfName} : '{$csrfValue}'},";
        }
        $route = $element->getRoute();
        if ($route) {
            $urlSubmit = $this->view->url($element->getRoute());
        } else {
            $urlSubmit = $element->getUploader();
        }
        $html .=<<<EOD
            <script type="text/javascript">
		$(function() {
                    $('#{$id}').uploadify({
                       {$formData}
                        swf: '{$element->getSwf()}',
                        uploader: '{$urlSubmit}',
                        height:{$element->getHeight()},
                        width:{$element->getWidth()},
                        uploadLimit:{$element->getUploadLimit()},
                        fileTypeExts:'{$element->getFileTypeExts()}',
                        fileSizeLimit:'{$element->getFileSizeLimit()}',
                        method:'{$element->getMethod()}',
                        buttonClass:'{$element->getButtonClass()}',
                        buttonText:'{$element->getButtonText()}',
                        auto:{$element->getAuto()},
                        cancelImg: '/module/Uploadify/public/uploadify-cancel.png',
                        onUploadSuccess: function(file, data, response) {
                            alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
                        }

                    });
		});
            </script>
EOD;
        return $html;
    }

    private function loadUploadifyScript() {
        if (!$this->uploadifyIsLoaded) {
            $this->uploadifyIsLoaded = true;
            return '
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
			<script src="/module/Uploadify/public/jquery.uploadify.min.js" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="/module/Uploadify/public/uploadify.css">';
        }
        return '';
    }

}
