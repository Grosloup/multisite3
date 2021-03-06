<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 03/09/14
 * Time: 09:59
 */
/*
         ____________________
__      /     ______         \
{  \ ___/___ /       }         \
{  /       / #      }          |
 {/ ô ô  ;       __}           |
 /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
 (_ _(    |   |   |  |   |   /    #
  (_ (_   |   |   |  |   |   |
    (__<  |mm_|mm_|  |mm_|mm_|
*/

namespace ZPB\Sites\ZooBundle\Controller\Parrainage;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Validator\Constraints as Assert;
use ZPB\AdminBundle\Controller\BaseController;
use ZPB\AdminBundle\Entity\Godparent;
use ZPB\Sites\ZooBundle\Form\Type\GodparentType;
use ZPB\Sites\ZooBundle\Form\Type\RecipientType;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $animals = $this->getRepo('ZPBAdminBundle:Animal')->findall();
        $categories = $this->getRepo('ZPBAdminBundle:AnimalCategory')->findall();
        return $this->render('ZPBSitesZooBundle:Parrainage/Index:index.html.twig', ['animals' => $animals, 'categories'=>$categories]);
    }

    public function connectAction()
    {
        return $this->render('ZPBSitesZooBundle:Parrainage/Index:connect_buttons.html.twig', []);
    }

    public function getBasketAction()
    {
        $items = $this->get('zpb.zoo.sponsor_basket')->count();
        return $this->render('ZPBSitesZooBundle:Parrainage/Index:get_basket.html.twig', ['basketCount'=>$items]);
    }

    public function showAnimalAction($name = "")
    {
        $animal = $this->getRepo('ZPBAdminBundle:Animal')->findOneByCanonicalLongName($name);
        if (!$animal) {
            //TODO page not found
            throw $this->createNotFoundException();
        }
        $formulas = $this->getRepo('ZPBAdminBundle:SponsoringFormula')->findByIsActive(true);
        $gifts = $this->getRepo('ZPBAdminBundle:SponsoringGiftDefinition')->getSortedResult();
        return $this->render(
            'ZPBSitesZooBundle:Parrainage/Index:show_animal.html.twig',
            ['animal' => $animal, 'formulas' => $formulas, 'gifts' => $gifts]
        );
    }

    public function addSponsoringToBasketAction(Request $request)
    {

        $csrfProv = $this->getCsrf();
        $form = $request->request->get("sponsorship_form", false);
        if (!$form) {
            throw $this->createAccessDeniedException();
        }
        $token = empty($form['_token']) ? false : $form['_token'];
        if (!$token || !$csrfProv->isCsrfTokenValid('add_sponsorship', $token)) {
            throw $this->createAccessDeniedException();
        }
        $packId = empty($form['pack']) ? false : $form['pack'];
        $animalId = empty($form['animal']) ? false : $form['animal'];
        $action = empty($form['submit']) ? false : $form['submit'];
        if (!$packId || !$animalId) {
            throw $this->createAccessDeniedException();
        }
        $pack = $this->getRepo('ZPBAdminBundle:SponsoringFormula')->find($packId);
        if (!$pack) {
            throw $this->createNotFoundException();
        }
        $animal = $this->getRepo('ZPBAdminBundle:Animal')->find($animalId);
        if (!$animal) {
            throw $this->createNotFoundException();
        }
        if (!$action) {
            throw $this->createNotFoundException();
        }
        $sb = $this->container->get('zpb.zoo.sponsor_basket');
        if ($action == 'offer') {
            $sb->addItem($pack, $animal);

            return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_add_recipient'));
        }

        $user = ($this->getUser() != null) ? $this->getUser() : null;
        $sb->addItem($pack, $animal, $user);
        return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_show_basket'));
    }

    public function addRecipientAction(Request $request)
    {
        $godparent = new Godparent();
        $emailForm = $this->get('form.factory')
            ->createNamedBuilder('godparent_by_email_form')
            ->add(
                'email',
                'email',
                [
                    'label' => 'Email',
                    'constraints' => [
                        new Assert\NotBlank(['message' => 'Ce champs est requis']),
                        new Assert\Email(
                            ['message' => 'Ce n\'est pas une email valide', 'checkMX' => true, 'checkHost' => true]
                        )
                    ]
                ]
            )
            ->add(
                'delayed',
                'date',
                [
                    'label' => 'Différer l\'envoi  (jj/mm/aaaa)',
                    'input' => 'datetime',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'constraints' => [
                        new Assert\Date(['message' => 'Cette date n\'est pas valide'])
                    ]
                ]
            )
            ->add('search', 'submit', ['label' => 'Enregistrer'])
            ->getForm();
        $form = $this->createForm(new RecipientType(), $godparent);
        if ($request->isMethod('post')) {
            if ($request->request->has('godparent_by_email_form')) {
                $emailForm->handleRequest($request);
                if ($emailForm->isValid()) {
                    $email = $emailForm->get('email')->getData();
                    $godparent = $this->getRepo('ZPBAdminBundle:Godparent')->findOneByEmail($email);
                    if (!$godparent) {
                        throw $this->createNotFoundException();
                    }
                    $sb = $this->container->get('zpb.zoo.sponsor_basket');
                    $lastItem = $sb->getLast();
                    $lastItem->setGodParent($godparent);
                    $delayed = $form->get('delayed')->getData();
                    if ($delayed) {
                        $lastItem->setDelayedAt($delayed);
                    }
                    $sb->add($lastItem);

                    return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_show_basket'));
                }
            }
            if ($request->request->has('recipient_form')) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $this->getManager()->persist($godparent);
                    $this->getManager()->flush();
                    $sb = $this->container->get('zpb.zoo.sponsor_basket');
                    $lastItem = $sb->getLast();
                    $lastItem->setGodParent($godparent);
                    $delayed = $form->get('delayed')->getData();
                    if ($delayed) {
                        $lastItem->setDelayedAt($delayed);
                    }
                    $sb->add($lastItem);

                    return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_show_basket'));
                }
            }
        }
        return $this->render(
            'ZPBSitesZooBundle:Parrainage/Index:add_recipient.html.twig',
            ['emailForm' => $emailForm->createView(), 'form' => $form->createView()]
        );
    }

    public function showBasketAction()
    {
        $sb = $this->container->get('zpb.zoo.sponsor_basket');
        $items = [];
        if (!$sb->isEmpty()) {
            $em = $this->getManager();
            foreach ($sb->getItems() as $k => $v) {
                $animalId = $v->getAnimal()->getId();
                $packId = $v->getPack()->getId();
                $godparent = null;
                if (null !== $godparent = $v->getGodparent()) {
                    $godparent = $em->find(get_class($godparent), $godparent->getId());
                }
                $animal = $em->find(get_class($v->getAnimal()), $animalId);
                $pack = $em->find(get_class($v->getPack()), $packId);
                $delayed = $v->getDelayedAt();
                $items[$v->getId()] = [
                    "pack" => $pack,
                    "animal" => $animal,
                    'godparent' => $godparent,
                    'delayed' => $delayed
                ];
            }
        }
        return $this->render('ZPBSitesZooBundle:Parrainage/Index:basket.html.twig', ['packs' => $items]);
    }

    public function removeSponsoringFromBasketAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        if (!$token || !$this->getCsrf()->isCsrfTokenValid('delete_from_basket', $token)) {
            throw $this->createAccessDeniedException(); //TODO
        }
        $sb = $this->container->get('zpb.zoo.sponsor_basket');
        if ($sb->removeItem($id)) {
            $this->setSuccess('L\'élément a bien été retiré de votre panier.');
        }
        return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_show_basket'));
    }

    public function loginOrRegisterAction(Request $request)
    {
        $type = $request->query->get('type',null);


        if ($this->getUser() && $this->get('security.context')->isGranted('ROLE_GODPARENT')) {
            return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_payment_recap',['type'=>$type]));
        }
        $goparent = new Godparent();
        $form = $this->createForm(new GodparentType(), $goparent);
        if($type != null){
            $form->get('type')->setData($type);
        }
        $form->handleRequest($request);
        if ($form->isValid()) {
            $type = $form->get('type')->getData();
            return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainages_payment_recap',['type'=>$type]));
        }
        return $this->render(
            'ZPBSitesZooBundle:Parrainage/Index:login_register.html.twig',
            ['form' => $form->createView()]
        );
    }

    public function recapOrderAfterLoginAction(Request $request)
    {
        $type = $request->query->get('type');
        if(!in_array($type, ['internt', 'postal'])){
            $type = 'internet';
        }
        $sb = $this->container->get('zpb.zoo.sponsor_basket');
        $items = [];
        if (!$sb->isEmpty()) {
            $em = $this->getManager();
            foreach ($sb->getItems() as $k => $v) {
                $animalId = $v->getAnimal()->getId();
                $packId = $v->getPack()->getId();
                $godparent = null;
                if (null !== $godparent = $v->getGodparent()) {
                    $godparent = $em->find(get_class($godparent), $godparent->getId());
                } else {
                    $godparent  = $this->getUser();
                }
                $animal = $em->find(get_class($v->getAnimal()), $animalId);
                $pack = $em->find(get_class($v->getPack()), $packId);
                $delayed = $v->getDelayedAt();
                $items[$v->getId()] = [
                    "pack" => $pack,
                    "animal" => $animal,
                    'godparent' => $godparent,
                    'delayed' => $delayed
                ];
            }
        }
        if($type == 'postal'){
            try{
                $command = $this->get('zpb.zoo.basket_to_command')->createCommand($this->container->get('zpb.zoo.sponsor_basket'), "postal",$this->getUser() );
            } catch (\Exception $e){
                throw $this->createNotFoundException($e->getMessage()); //TODO page d'erreur pour commande parrainage
            }
            if($command != null){
                throw $this->createNotFoundException(); //TODO page d'erreur pour commande parrainage
            }

            return $this->render('ZPBSitesZooBundle:Parrainage/Index:recap_order_postal.html.twig', ['items'=>$items]);
        }


        try{
            $command = $this->get('zpb.zoo.basket_to_command')->createCommand($this->container->get('zpb.zoo.sponsor_basket'), "internet",$this->getUser() );
        } catch (\Exception $e){
            throw $this->createNotFoundException($e->getMessage()); //TODO page d'erreur pour commande parrainage
        }

        if($command == null){
            throw $this->createNotFoundException(); //TODO page d'erreur pour commande parrainage
        }

        $bankDatas = $this->container->getParameter('zpb.zoo.bank_datas');
        $date = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        $dateFormated = $date->format('d/m/Y:H:i:s');
        $freeText = '';
        $amount = $command->getTotalAmountTtc().'EUR';
        $refCommand = $command->getTmpId();
        $userEmail = $this->getUser()->getEmail();
        $macMaker = $this->get('zpb.zoo.bank_mac_maker');

        $mac = $macMaker->createMac($dateFormated, $amount, $refCommand, $freeText, $userEmail);

        $form = $this->get('form.factory')->createNamedBuilder(null,'form')
                    ->setAction($bankDatas['url_test'])
                    ->add('version', 'hidden', ['data'=>$bankDatas['version']])
                    ->add('TPE', 'hidden', ['data'=>$bankDatas['TPE']])
                    ->add('date', 'hidden', ['data'=>$dateFormated])
                    ->add('montant', 'hidden', ['data'=>$amount])
                    ->add('reference', 'hidden', ['data'=>$refCommand])
                    ->add('MAC', 'hidden', ['data'=>$mac])
                    ->add('url_retour', 'hidden', ['data'=>$bankDatas['url_retour'].'?order='.$refCommand])
                    ->add('url_retour_ok', 'hidden', ['data'=>$bankDatas['url_retour_ok'].'?order='.$refCommand])
                    ->add('url_retour_err', 'hidden', ['data'=>$bankDatas['url_retour_err'].'?order='.$refCommand])
                    ->add('lgue', 'hidden', ['data'=>$bankDatas['lgue']])
                    ->add('societe', 'hidden', ['data'=>$bankDatas['societe']])
                    ->add('texte-libre', 'hidden', ['data'=>$freeText])
                    ->add('mail', 'hidden', ['data'=>$userEmail])
                    ->add('bouton', 'submit', ['label'=>'Paiement'])
                    ->getForm()
            ;
        $sb->flush();
        return $this->render('ZPBSitesZooBundle:Parrainage/Index:recap_order.html.twig', ['items'=>$items, 'form'=>$form->createView()]);
    }


}
