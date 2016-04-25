<?php

namespace App\Core;

use App\Entity\Register;
use App\Entity\Attribute;
use App\Entity\Entity;

class AttributeManager {
	// TODO: DONT'T LEAVE ME THIS WAY! HOW ABOUT TEMPLATE FILES?
	const FORM 			= 'Form <form method="post" action="/test/create-register/{ID-ENTITY}" class="form-horizontal" data-form="partial-form">{FIELDS}<input type="submit" value="submit"></form>';
	const FORM_REGISTER = 'Form <form method="post" action="/test/update-register/{ID-ENTITY}/{ID-REGISTER}" class="form-horizontal" data-form="partial-form">{FIELDS}<input type="submit" value="submit"></form>';

	protected static $idAttribute;
	protected static $idAttributeValue;
	protected static $idType;
	protected static $name;
	protected static $placeholder;
	protected static $classCss;
	protected static $size;
	protected static $inline;
	protected static $value;
	protected static $html;

	/**
	 * @var \App\Entity\Attribute
	 */
	protected static $attribute;

	/**
	 * @var \App\Entity\Register
	 */
	protected static $register;

	/**
	 * @var \App\Entity\Type
	 */
	protected static $type;

	/**
	 * @var \App\Core\AttributeManager
	 */
	private static $instance = null;

	private static $em;

    private function __construct () { }

    /**
     * @param \Doctrine\ORM\EntityManager $em
     *
     * @return \App\Core\AttributeManager
     */
    public static function getInstance($em = null) {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        if($em == null && self::$em == null)
        	throw new \Exception("AttributeManager must have an instance of EntityManager!");

        if($em)
			self::$em = $em;

        return self::$instance;
    }

    public function getEntityManager() {
    	return self::$em;
    }

    /**
     * @param  string $value
     * @return \App\Core\AttributeManager
     */
	public function setHtml($value) {
		self::$html = $value;

		return $this;
	}

    /**
     * @param  string $value
     * @return \App\Core\AttributeManager
     */
	public function setName($value) {
		self::$name = $value;		

		return $this;
	}

    /**
     * @param  int $value
     * @return \App\Core\AttributeManager
     */
	public function setId($id) {
		self::$idAttribute = $id;

		return $this;
	}

    /**
     * @param  string $value
     * @return \App\Core\AttributeManager
     */
	public function setPlaceholder($value) {
		self::$placeholder = $value;

		return $this;
	}

    /**
     * @param  string $value
     * @return \App\Core\AttributeManager
     */
	public function setClassCss($value) {
		self::$classCss = $value;

		return $this;
	}

    /**
     * @param  int $value
     * @return \App\Core\AttributeManager
     */
	public function setSize($value) {
		self::$size = $value;

		return $this;
	}

    /**
     * @param  bool $value
     * @return \App\Core\AttributeManager
     */
	public function setInline($value) {
		self::$inline = $value;

		return $this;
	}

	/**
     * @param  string|int|null $value
     * @return \App\Core\AttributeManager
     */
	public function setValue($value = null) {
		self::$value = $value;
		
		return $this;
	}

	/**
	 * @return string
	 */
	public function render() {
		$html 			= self::$html;

		$toBereplaced 	= array("{ID}", 
								"{NAME}", 
								"{PLACEHOLDER}", 
								"{CLASS-CSS}", 
								"{SIZE}",
								"{INLINE}",
								"{VALUE}",
								"{ID-ATTRIBUTE-VALUE}",
								"{ID-TYPE}");

		$toReplace    	= array(self::$idAttribute, 
								self::$name, 
								self::$placeholder, 
								self::$classCss, 
								self::$size,
								self::$inline,
								self::$value,
								self::$idAttributeValue,
								self::$idType);

		return str_replace($toBereplaced, $toReplace, $html); 
	}

	/**
	 * Use to render an attribute field; used in renderField
	 *
	 * @param \App\Entity\Attribute|null $attribute
	 * @param \App\Entity\Type|null 		$type
	 * @param int|string|null 					$value
	 * 
	 * @return string
	 */
	public function renderAttribute(Attribute $attribute = null, 
									Type $type 	   		 = null, 
									$value 	   			 = null) {
		if(!is_null($attribute))
			self::$attribute = $attribute;

		if(!is_null($type))
			self::$type = $type;

		if(!is_null($value))
			self::$value = $value;

		if(self::$type instanceOf \App\Entity\Type) {
			$attCss = self::$attribute->getCss();

			// override base css (from type) if attribute has css value
			$css = !empty($attCss) ? $attCss : self::$type->getCss();

			return self::getInstance()->setHtml(self::$type->getHtml())
						 			  ->setId(self::$attribute->getId())
						 			  ->setName(self::$attribute->getName())
						 			  ->setPlaceholder(self::$attribute->getName())
						 			  ->setClassCss($css)
						 			  ->setValue(self::$value)
						 			  ->render();
		}

		return "";
	}

	/**
	 * 
	 * @param \App\Entity\Attribute 		$attribute
	 * @param \App\Entity\Register|null  $register
	 * 
	 * @return string 
	 *
	 * Use to render the form input
	 * Pass without $register value if do not want to show values	
	 */
	public function renderField(Attribute $attribute, 
								Register  $register = null) {
		self::$value 	 = null;
		self::$register  = $register;
		self::$attribute = $attribute;
		self::$type  	 = $attribute->getType();
		
		// get register value only if render field have a register
		// otherwise, you don't have a velue to catch
		if(!is_null($register)) {
			$attrValue = self::$instance->getAttributeValue($attribute, 
															$register);    

	        if(!is_null($attrValue)) {
	            self::$value = $attrValue->getValue();
	        }	
		}
         
        return $this->renderAttribute();
	}

	/**
	 * @param \App\Entity\Entity $entity
	 * @param \App\Entity\Register|null $register
	 * 
	 * @return string
	 *
	 * Render only attributes and attrbute values
	 */
	public function renderForm(Entity   $entity, 
							   Register $register = null) {
		$form = "";

		if($register != null) {
			$form .= "<h2>App: {$register->getState()->getModule()->getApplication()->getName()}</h2>";
			$form .= "<h3>Entity: {$register->getEntity()->getName()}</h3>";
			$form .= "<h4>State: {$register->getState()->getName()}</h4>";
			$form .= "<h4>Module: {$register->getState()->getModule()->getName()}</h4>";
		}

		if($entity instanceOf \App\Entity\Entity) {            
			$attributes = self::$em->getRepository('App\Entity\Entity')
								   ->getAttributesByOrder($entity);

			foreach ($attributes as $attribute) {
                $form .= self::getInstance()
                             ->renderField($attribute, 
                                           $register);
            }
        }

		return $form;
	}
	
	/**
	 * @param \App\Entity\Entity $entity
	 * @param \App\Entity\Register|null $register
	 * 
	 * @return string
	 *
	 * Render form based on attribute and attribute values list
	 */
	public function renderFormOnPartialForm(Entity   $entity, 
				 						    Register $register = null) {

		$arrayForm   = array("{ID-ENTITY}","{ID-REGISTER}","{FIELDS}");

		$form 	     = $this->renderForm($entity, $register);

		$arrayValues = array($entity->getId(), 
							 !is_null($register) ? $register->getId() : null,
							 $form);

        if(!is_null($register))
			$form = str_replace($arrayForm, $arrayValues, self::FORM_REGISTER);        
		else
			$form = str_replace($arrayForm, $arrayValues, self::FORM);        

        return $form;
	}

	/**
     * @param Attribute $attribute
     * @param Register  $register
     *
     * @return object|null
     */
    public function getAttributeValue(Attribute $attribute, 
    								  Register  $register) {
		
    	$em = self::$em;

		if($attribute->getType() instanceOf \App\Entity\Type) {
			self::$type = $attribute->getType();
		}

		switch ((int) self::$type->getId()) {
			case 1:
				// return AttributeValueInt
				$repository = $em->getRepository('App\Entity\AttributeValueInt');
				break;
			
			case 2:
				$repository = $em->getRepository('App\Entity\AttributeValueString32');
				break;

			case 3:
                $repository = $em->getRepository('App\Entity\AttributeValueString256');
                break;

			default:
				return null;
				break;
		}

		return $repository->getAttributeValue($register,
							 				  $attribute);
	}

	/**
     * @param Attribute $attribute
     * @param Register  $register
     */
    public function setAttributeValue(Attribute $attribute, 
    								  Register  $register,
    								  $value = null) {
		
		if($attribute->getType() instanceOf \App\Entity\Type) {
			self::$type = $attribute->getType();
		}

		switch ((int) self::$type->getId()) {
			case 1:
				$attrValue = new \App\Entity\AttributeValueInt();
				break;
			
			case 2:
				$attrValue = new \App\Entity\AttributeValueString32();
				break;

			case 3:
                $attrValue = new \App\Entity\AttributeValueString256();
                break;

			default:
				break;
		}

		$attrValue->setValue($value);
		$attrValue->setRegister($register);
		$attrValue->setAttribute($attribute);
		self::$em->persist($attrValue);
		self::$em->flush();
	}
}