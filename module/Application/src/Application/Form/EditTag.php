<?php
/**
 * EditTag Form
 *
 * @package Application\Form
 * @author Ali Abu El Haj <aaelhaj@nerdery.com>
 */
namespace Application\Form;

use Application\Entity\Tag;
use Zend\Form\Form;

/**
 * EditTag Form
 * @package Application\Form
 */
class EditTag extends \Zend_Form
{
    /**
     * @var Tag
     */
    protected $tag;


    public function init() {

        parent::init();
        $this->addElement(
            $this->createElement("text", "name")
                ->setLabel("Product Name")
                ->setRequired(true)
                ->addFilters(array('StripTags', 'StringTrim'))
                ->setAttrib('class', 'product-name')
        );

        $this->addElement(
            $this->createElement("submit", "Submit")
                ->setLabel("Edit Tag")
        );
        $this->setElementDecorators(
            array(
                array(
                    'ViewHelper',
                ),
            )
        );
        $view = new \Zend_View();
        $view->addScriptPath(ROOT_PATH.'/modules/Application/view/application/tag');
        $this->setView($view);

    }


    /**
     * @param Tag $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return Tag
     * @throws \Exception
     */
    public function getTag()
    {
        if ($this->tag === null) {
            throw new \Exception('Invalid Tag');
        }
        return $this->tag;
    }


    /**
     * Persist data to the tag entity
     * @return Tag $tag
     */
    public function persistData()
    {
        return $this->getTag()
            ->setName($this->getElement('name')->getValue());
    }
}