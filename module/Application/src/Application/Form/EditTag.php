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
//        $view->addBasePath(APPLICATION_SCRIPT_PATH);
//        $replyForm = new Form_MailReply();
        $this->setView($view);

    }
//    /**
//     * constructor
//     */
//    public function __construct()
//    {
//        $this->tag = $tag;
//        parent::__construct('editTag');
//        $this->setAttributes(
//            array(
//                'method' => 'post',
//                'class'  => 'form-horizontal',
//            )
//        );
//        $this->add(array(
//            'name' => 'name',
//            'attributes' => array(
//                'type'  => 'text',
//                'value' => $this->getVideo()->getTitle(),
//                'class' => 'form-control'
//            ),
//            'options' => array(
//                'label' => 'Title',
//                'class' => 'col-sm-2 control-label'
//            ),
//        ));
//        $this->add(array(
//            'name' => 'videoFileName',
//            'attributes' => array(
//                'type'  => 'text',
//                'value' => $this->getVideo()->getVideoFileName(),
//                'class' => 'form-control'
//            ),
//            'options' => array(
//                'label' => 'Video Filename',
//            ),
//        ));
//
//        $this->add(array(
//            'name' => 'vttFileName',
//            'attributes' => array(
//                'type'  => 'text',
//                'value' => $this->getVideo()->getVttFileName(),
//                'class' => 'form-control'
//            ),
//            'options' => array(
//                'label' => 'WebVTT Filename',
//            ),
//        ));
//
//
//        $this->add(array(
//            'name' => 'submit',
//            'attributes' => array(
//                'class' => 'btn',
//                'type'  => 'submit',
//                'value' => 'Submit',
//                'id' => 'submitbutton',
//            ),
//        ));
//    }

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