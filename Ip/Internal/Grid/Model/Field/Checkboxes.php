<?php
/**
 * @package   ImpressPages
 */

namespace Ip\Internal\Grid\Model\Field;


class Checkboxes extends \Ip\Internal\Grid\Model\Field
{
    protected $field = '';
    protected $label = '';
    protected $defaultValue = '';
    protected $values = array();

    public function __construct($fieldFieldConfig, $wholeConfig)
    {
        if (empty($fieldFieldConfig['field'])) {
            throw new \Ip\Exception('\'field\' option required for text field');
        }
        $this->field = $fieldFieldConfig['field'];

        if (!empty($fieldFieldConfig['label'])) {
            $this->label = $fieldFieldConfig['label'];
        }

        if (!empty($fieldFieldConfig['values'])) {
            $this->values = $fieldFieldConfig['values'];
        }

        if (!empty($fieldFieldConfig['defaultValue'])) {
            $this->defaultValue = $fieldFieldConfig['defaultValue'];
        }
    }

    public function preview($recordData) 
    {
        if ($this->previewMethod) {
        return call_user_func($this->previewMethod, $recordData);
        } else {
        return '';
        }
    }

    public function createField()
    {
        $field = new \Ip\Form\Field\Checkboxes(array(
            'label' => $this->label,
            'name' => $this->field,
            'values' => $this->values,
            'layout' => $this->layout
        ));
        $field->setValue($this->defaultValue);
        return $field;
    }

    public function createData($postData)
    {
        if (isset($postData[$this->field])) {
            return array($this->field => json_encode($postData[$this->field]));
        }
        return array();
    }

    public function updateField($curData)
    {
        $field = new \Ip\Form\Field\Checkboxes(array(
            'label' => $this->label,
            'name' => $this->field,
            'values' => $this->values,
            'layout' => $this->layout
        ));
        $field->setValue(json_decode($curData[$this->field]));
        return $field;
    }

    public function updateData($postData)
    {
        return array($this->field => json_encode($postData[$this->field]));
    }


    public function searchField($searchVariables)
    {
        $values = array(array(null, 'Any'));
        $values = array_merge($values, $this->values);

        $field = new \Ip\Form\Field\Checkboxes(array(
            'label' => $this->label,
            'name' => $this->field,
            'values' => $values,
            'layout' => $this->layout
        ));
        if (!empty($searchVariables[$this->field])) {
            $field->setValue($searchVariables[$this->field]);
        }
        return $field;
    }

    public function searchQuery($searchVariables)
    {
        if (isset($searchVariables[$this->field]) && $searchVariables[$this->field] !== '') {
            return '`' . $this->field . '` = ' . ipDb()->getConnection()->quote($searchVariables[$this->field]) . ' ';
        }
        return null;
    }
}