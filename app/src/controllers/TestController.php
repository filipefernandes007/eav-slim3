<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Core\AttributeManager;

final class TestController extends BaseController
{
    
    public function entity(Request $request, Response $response, $args)
    {
        
        $object = $this->em
                       ->find('App\Entity\Entity', intval($args['id']));

        if($object != null)               
            var_dump($object->getName());               

        echo "This is the test page";
    }

    public function state(Request $request, Response $response, $args) {
        $object = $this->em
                       ->find('App\Entity\State', intval($args['id']));

        if($object != null)               
            var_dump($object->getName());     
    }

    public function application(Request $request, Response $response, $args) {
        $object = $this->em
                       ->find('App\Entity\Application', intval($args['id']));

        if($object != null)               
            var_dump($object->getName());     
    }

    public function module(Request $request, Response $response, $args) {
        $object = $this->em
                       ->find('App\Entity\Module', intval($args['id']));

        if($object != null)               
            var_dump($object->getName());     
    }

    public function register(Request $request, Response $response, $args) {
        $utils = AttributeManager::getInstance($this->em);
        $form  = "";   
        $id    = intval($args['id']);

        if(!is_null($id)) {
            $register = $this->em
                             ->find('App\Entity\Register', intval($args['id']));

            if(!is_null($register)) {
                // get entity related with register                
                $entity = $register->getEntity();
                $parent = $register->getParent();
                $form   = $utils->renderForm($entity, $register); 

                if(!is_null($parent)) {
                    $formParent = $utils->renderForm($parent->getEntity(), $parent);
                }

                $children      = $register->getChildren();
                $childEntities = $this->em
                                      ->getRepository('App\Entity\Register')
                                      ->getChildrenEntity($register);
        
            } else {
                throw new \Exception("Register is NULL!");    
            }
       }

        $this->view->render($response, 
                            '\tests\register.html.twig', 
                            array(
                                'id_entity'     => $register->getEntity()
                                                            ->getId(),
                                'id_register'   => $id,
                                'parent'        => $parent,
                                'fields'        => $form,
                                'parentForm'    => !is_null($parent) ? $formParent : null,
                                'children'      => $children,
                                'childEntities' => $childEntities
                                )
                            );    
    }

    public function attribute(Request $request, Response $response, $args) {
        $object = $this->em
                       ->find('App\Entity\Attribute', intval($args['id']));

        if($object != null)               
            var_dump($object->getName());     
    }

    public function type(Request $request, Response $response, $args) {
        $object = $this->em
                       ->find('App\Entity\Type', intval($args['id']));

        if($object != null)               
            var_dump($object->getName());     
    }

    public function attributeValueInt(Request $request, Response $response, $args) {
        $object = $this->em
                       ->find('App\Entity\AttributeValueInt', intval($args['id']));

        if($object != null)               
            var_dump($object->getRegister()->getId());     
    }

    public function attributeValueString32(Request $request, Response $response, $args) {
        $object = $this->em
                       ->find('App\Entity\AttributeValueString32', intval($args['id']));

        if($object != null)               
            var_dump($object->getValue() . " RegisterID: " . $object->getRegister()->getId());     
    }

    public function attributeValueString256(Request $request, Response $response, $args) {
        $object = $this->em
                       ->find('App\Entity\AttributeValueString256', intval($args['id']));

        if($object != null)               
            var_dump($object->getValue() . " RegisterID: " . $object->getRegister()->getId());     
    }

    /**
     *
     */
    public function listChildRegisters(Request $request, Response $response, $args) {
        $register = $this->em
                         ->getRepository('App\Entity\Register')
                         ->findOneById(intval($args['id']));

        if($register !== null) {
            $registers = $register->getChildren();

            if(sizeof($registers) == 0) {
                print("No results!");

                return;
            }

            print($registers[0]->getEntity()->getName() . "<br/>");
            print("Nº de filhos: " . sizeof($registers) . "<br/>");

            foreach ($registers as $register) {
                print("<a href='/test/register/{$register->getId()}'>{$register->getId()}</a><br/>");
            }
        } else {

        }
    }

    /**
     *
     */
    public function createRegister(\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) {

        $utils    = AttributeManager::getInstance($this->em);
        $idEntity = intval($args['id_entity']);
        $idState  = intval($args['id_state']);
        
        $entity = $this->em
                       ->getRepository('App\Entity\Entity')
                       ->findOneById($idEntity);

        $state  = $this->em
                       ->getRepository('App\Entity\State')
                       ->findOneById($idState);    

        if($entity == null)
            throw new \Exception("Can't find entity!");

        if($state == null)
            throw new \Exception("Can't find state!");         
                     
        try {
            $register = new \App\Entity\Register();

            $register->setState($state);
            $register->setEntity($entity);
            $this->em->persist($register);        
            $this->em->flush();                     
        } catch (\Exception $e) {
            print("Erro! " . $e->getMessage());
            die; 
        }             
        
        foreach ($_POST['attr'] as $key => $value) {
            $attribute = $this->em
                              ->getRepository('App\Entity\Attribute')
                              ->findOneBy(array('id'      => $key, 
                                                'entity'  => $entity));

            $utils->setAttributeValue($attribute, $register, $value);                        
        }

        return $response->withStatus(301)
                        ->withHeader('Location', 
                                     "/test/register/{$register->getId()}");
    }
    
    /**
     * @param array $args
     */
    public function newRegister(\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) {
        $utils    = AttributeManager::getInstance($this->em);
        $form     = "";
        $idEntity = intval($args['id_entity']); 
        $idState  = intval($args['id_state']); 
        
        $entity   = $this->em
                         ->getRepository('App\Entity\Entity')
                         ->findOneById($idEntity);

        $state    = $this->em
                         ->getRepository('App\Entity\State')
                         ->findOneBy(array('id' => $idState, 'entity' => $entity));

        if($entity == null)
            throw new \Exception("Can't find entity!");

        if($state == null)
            throw new \Exception("Can't find state!");

        $form = $utils->renderForm($entity);
        
        return $this->view
                    ->render($response,
                      '\tests\new-register.html.twig', 
                        array(
                            'state_name'    => $state->getName(),
                            'entity_name'   => $entity->getName(),
                            'id_entity'     => $idEntity,
                            'id_state'      => $idState,
                            'fields'        => $form
                        )
               );
    }

    /**
     *
     */
    public function updateRegister(Request $request, Response $response, $args) {
        $utils = AttributeManager::getInstance($this->em);
        $id    = intval($args['id']);
        
        /**
         * @var \App\Entity\Register
         */        
        $register = $this->em
                         ->getRepository('App\Entity\Register')
                         ->find($id);

        $id_entity = $register->getEntity()->getId();

        foreach ($_POST['attr'] as $idAttribute => $value) {
            $attribute = $this->em
                              ->getRepository('App\Entity\Attribute')
                              ->find($idAttribute);

            if($attribute == null)
                continue;

            $attrValue = $utils->getAttributeValue($attribute, $register);

            if($attrValue == null)
                continue;

            $attrValue->setValue($value);
            $this->em->persist($attrValue);
            $this->em->flush();
        }

        return $response->withStatus(301)
                        ->withHeader('Location', "/test/register/{$id}");
    }

}
