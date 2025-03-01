<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Activity;
use App\Entity\FollowUp;
use App\Entity\Goal;
use App\Entity\Product;
use App\Entity\Veterinary;
use App\Entity\Category;
use App\Entity\User;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $djourMoins45jours = (new \Datetime())->sub(new \DateInterval('P45D'));
        $djourMoins30jours = (new \Datetime())->sub(new \DateInterval('P30D'));
        $djourMoins20jours = (new \Datetime())->sub(new \DateInterval('P20D'));
        $djourMoins15jours = (new \Datetime())->sub(new \DateInterval('P15D'));
        $djourMoins5jours = (new \Datetime())->sub(new \DateInterval('P5D'));
        $anneeCourante = \date("Y");
        $dateAujourdhui = new \DateTime('now');

         //region Les catégories

         $categorie1 = new Category();
         $categorie1->setName('cabinet vétérinaire');
         $manager->persist($categorie1);
         
         $categorie2 = new Category();
         $categorie2->setName('clinique vétérinaire');
         $manager->persist($categorie2);
         
         $categorie3 = new Category();
         $categorie3->setName('centre hospitalier vétérinaire');
         $manager->persist($categorie3);
         
         $categorie4 = new Category();
         $categorie4->setName('centre de vétérinaires spécialisés');
         $manager->persist($categorie4);
 
         //endregion

        //region Les activités
        $activite1 = new Activity();
        $activite1->setDescription('Consultation');
        $manager->persist($activite1);

        $activite2 = new Activity();
        $activite2->setDescription('Chirurgie générale');
        $manager->persist($activite2);

        $activite3 = new Activity();
        $activite3->setDescription('Soins intensifs');
        $manager->persist($activite3);

        $activite4 = new Activity();
        $activite4->setDescription('24h/24');
        $manager->persist($activite4);

        $activite5 = new Activity();
        $activite5->setDescription('Service de garde');
        $manager->persist($activite5);

        $activite6 = new Activity();
        $activite6->setDescription('Hospitalisation');
        $manager->persist($activite6);

        $activite7 = new Activity();
        $activite7->setDescription('Imagerie médicale');
        $manager->persist($activite7);
        //endregion

        //region Les vétérinaires
        $veto1 = new Veterinary();
        $veto1->setName('Lasseau et Desguerre');
        $veto1->setAddress('3 rue du 11 novembre');
        $veto1->setPostalCode('60340');
        $veto1->setCity('SAINT LEU D\'ESSERENT');
        $veto1->setPhonep('03.44.55.66.77');
        $veto1->setImageFileName('17.jpg');
        $veto1->setCreationDate($djourMoins45jours);
        $veto1->setCategory($categorie1);
        $veto1->addActivity($activite1);
        $veto1->addActivity($activite2);
        $veto1->addActivity($activite5);
        $veto1->addActivity($activite6);
        $manager->persist($veto1);

        $veto2 = new Veterinary();
        $veto2->setName('Saudubray Jérôme');
        $veto2->setAddress('86 rue de la république');
        $veto2->setPostalCode('60100');
        $veto2->setCity('CREIL');
        $veto2->setPhonep('03.44.99.88.77');
        $veto2->setImageFileName('12.jpg');
        $veto2->setCreationDate($djourMoins45jours);
        $veto2->setCategory($categorie1);
        $veto2->addActivity($activite1);
        $veto2->addActivity($activite2);
        $veto2->addActivity($activite5);
        $veto2->addActivity($activite6);
        $manager->persist($veto2);

        $veto3 = new Veterinary();
        $veto3->setName('Brahim et Radji');
        $veto3->setAddress('64 avenue Claude Péroche');
        $veto3->setPostalCode('60180');
        $veto3->setCity('NOGENT SUR OISE');
        $veto3->setPhonep('03.22.54.88.77');
        $veto3->setImageFileName('14.jpg');
        $veto3->setCreationDate($djourMoins30jours);
        $veto3->setCategory($categorie2);
        $veto3->addActivity($activite1);
        $veto3->addActivity($activite2);
        $veto3->addActivity($activite3);
        $veto3->addActivity($activite5);
        $veto3->addActivity($activite6);
        $veto3->addActivity($activite7);
        $manager->persist($veto3);

        $veto4 = new Veterinary();
        $veto4->setName('Clinique Duvernet');
        $veto4->setAddress('30 rue des lilas');
        $veto4->setPostalCode('60500');
        $veto4->setCity('CHANTILLY');
        $veto4->setPhonep('03.44.55.99.88');
        $veto4->setImageFileName('1.jpg');
        $veto4->setCreationDate($djourMoins20jours);
        $veto4->setCategory($categorie3);
        $veto4->addActivity($activite1);
        $veto4->addActivity($activite2);
        $veto4->addActivity($activite3);
        $veto4->addActivity($activite4);
        $veto4->addActivity($activite5);
        $veto4->addActivity($activite6);
        $veto4->addActivity($activite7);
        $manager->persist($veto4);

        $veto5 = new Veterinary();
        $veto5->setName('Chambly Vétérinaires');
        $veto5->setAddress('25 rue du pont');
        $veto5->setPostalCode('60230');
        $veto5->setCity('CHAMBLY');
        $veto5->setPhonep('01.02.01.02.01');
        $veto5->setImageFileName('18.jpg');
        $veto5->setCreationDate($djourMoins5jours);
        $veto5->setCategory($categorie3);
        $veto5->addActivity($activite1);
        $veto5->addActivity($activite2);
        $veto5->addActivity($activite5);
        $veto5->addActivity($activite6);
        $manager->persist($veto5);

        $veto6 = new Veterinary();
        $veto6->setName('Clinique vétérinaire de Diane');
        $veto6->setAddress('26 rue Victor Hugo');
        $veto6->setPostalCode('60500');
        $veto6->setCity('CHANTILLY');
        $veto6->setPhonep('03.44.58.28.48');
        $veto6->setImageFileName('13.jpg');
        $veto6->setCreationDate($djourMoins5jours);
        $veto6->setCategory($categorie4);
        $veto6->addActivity($activite1);
        $veto6->addActivity($activite2);
        $veto6->addActivity($activite5);
        $veto6->addActivity($activite6);
        $manager->persist($veto6);
        //endregion

        //region Les produits
        $produit1 = new Product();
        $produit1->setName('Feliway diffuseur 48ml');
        $produit1->setPrice(24.99);
        $produit1->setDate($dateAujourdhui);
        $manager->persist($produit1);

        $produit2 = new Product();
        $produit2->setName('Feliway recharge 48ml');
        $produit2->setPrice(19.99);
        $produit2->setDate($dateAujourdhui);
        $manager->persist($produit2);

        $produit3 = new Product();
        $produit3->setName('Feliway spray 60ml');
        $produit3->setPrice(22.99);
        $produit3->setDate($dateAujourdhui);
        $manager->persist($produit3);

        $produit4 = new Product();
        $produit4->setName('Feliway spray 20ml');
        $produit4->setPrice(11.99);
        $produit4->setDate($dateAujourdhui);
        $manager->persist($produit4);

        $produit5 = new Product();
        $produit5->setName('Dermoscent Pipettes Essential 6 spot-on chien <10kg');
        $produit5->setPrice(15.75);
        $produit5->setDate($dateAujourdhui);
        $manager->persist($produit5);

        $produit6 = new Product();
        $produit6->setName('Dermoscent Pipettes Essential 6 spot-on chien >20kg');
        $produit6->setPrice(20.95);
        $produit6->setDate($dateAujourdhui);
        $manager->persist($produit6);

        $produit7 = new Product();
        $produit7->setName('Dermoscent Pipettes Essential 6 spot-on chien 10-20kg');
        $produit7->setPrice(18.25);
        $produit7->setDate($dateAujourdhui);
        $manager->persist($produit7);

        $produit8 = new Product();
        $produit8->setName('Dermoscent Bio Balm soin coussinets plantaires et de la truffe');
        $produit8->setPrice(12.09);
        $produit8->setDate($dateAujourdhui);
        $manager->persist($produit8);

        $produit9 = new Product();
        $produit9->setName('Dermoscent Keravita pour chiens et chats');
        $produit9->setPrice(15.26);
        $produit9->setDate($dateAujourdhui);
        $manager->persist($produit9);

        $produit10 = new Product();
        $produit10->setName('Dermoscent Essential 6 Spot-on chat');
        $produit10->setPrice(16.39);
        $produit10->setDate($dateAujourdhui);
        $manager->persist($produit10);

        $produit11 = new Product();
        $produit11->setName('Collier Seresto GSB - Anti-puces et tiques pour chat');
        $produit11->setPrice(20.89);
        $produit11->setDate($dateAujourdhui);
        $manager->persist($produit11);

        $produit12 = new Product();
        $produit12->setName('Pipettes Fiprospot Spot-On - Anti-puces pour chat - 3 pipettes');
        $produit12->setPrice(7.14);
        $produit12->setDate($dateAujourdhui);
        $manager->persist($produit12);

        $produit13 = new Product();
        $produit13->setName('Pipettes Fiprospot Spot-On - Anti-puces pour chat - 6 pipettes');
        $produit13->setPrice(12.34);
        $produit13->setDate($dateAujourdhui);
        $manager->persist($produit13);

        $produit14 = new Product();
        $produit14->setName('Collier Seresto GSB - Anti-puces et tiques pour chien < 8kg');
        $produit14->setPrice(22.79);
        $produit14->setDate($dateAujourdhui);
        $manager->persist($produit14);

        $produit15 = new Product();
        $produit15->setName('Collier Seresto GSB - Anti-puces et tiques pour chien > 8kg');
        $produit15->setPrice(25.64);
        $produit15->setDate($dateAujourdhui);
        $manager->persist($produit15);

        $produit16 = new Product();
        $produit16->setName('Pipettes Fiprospot Spot-on - Anti-puces et tiques pour petit chien (2-10kg); - 6 pipettes');
        $produit16->setPrice(15.59);
        $produit16->setDate($dateAujourdhui);
        $manager->persist($produit16);

        $produit17 = new Product();
        $produit17->setName('Pipettes Fiprospot Spot-on - Anti-puces et tiques pour chien moyen (10-20kg) - 6 pipettes');
        $produit17->setPrice(17.54);
        $produit17->setDate($dateAujourdhui);
        $manager->persist($produit17);

        $produit18 = new Product();
        $produit18->setName('Pipettes Fiprospot Spot-on - Anti-puces et tiques pour grandchien (20-40kg) - 6 pipettes');
        $produit18->setPrice(20.79);
        $produit18->setDate($dateAujourdhui);
        $manager->persist($produit18);

        $produit19 = new Product();
        $produit19->setName('Pipettes Fiprospot Spot-on - Anti-puces et tiques pour chien géant (40-60kg) - 6 pipettes');
        $produit19->setPrice(22.74);
        $produit19->setDate($dateAujourdhui);
        $manager->persist($produit19);
        //endregion

       

        //region Les objectifs
        $objectif = new Goal();
        $objectif->setVeterinary($veto1);
        $objectif->setProduct($produit1);
        $objectif->setAmount(500);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);

        $objectif = new Goal();
        $objectif->setVeterinary($veto1);
        $objectif->setProduct($produit1);
        $objectif->setAmount(450);
        $objectif->setYear($anneeCourante-1);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto1);
        $objectif->setProduct($produit1);
        $objectif->setAmount(400);
        $objectif->setYear($anneeCourante-2);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto1);
        $objectif->setProduct($produit7);
        $objectif->setAmount(1000);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto1);
        $objectif->setProduct($produit3);
        $objectif->setAmount(500);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto1);
        $objectif->setProduct($produit8);
        $objectif->setAmount(800);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto1);
        $objectif->setProduct($produit12);
        $objectif->setAmount(500);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto1);
        $objectif->setProduct($produit9);
        $objectif->setAmount(1500);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto2);
        $objectif->setProduct($produit1);
        $objectif->setAmount(800);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto2);
        $objectif->setProduct($produit2);
        $objectif->setAmount(520);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto2);
        $objectif->setProduct($produit2);
        $objectif->setAmount(500);
        $objectif->setYear($anneeCourante-1);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto2);
        $objectif->setProduct($produit2);
        $objectif->setAmount(400);
        $objectif->setYear($anneeCourante -2);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto2);
        $objectif->setProduct($produit3);
        $objectif->setAmount(520);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto2);
        $objectif->setProduct($produit5);
        $objectif->setAmount(1000);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto2);
        $objectif->setProduct($produit12);
        $objectif->setAmount(800);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto5);
        $objectif->setProduct($produit1);
        $objectif->setAmount(700);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto5);
        $objectif->setProduct($produit2);
        $objectif->setAmount(1800);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);

        $objectif = new Goal();
        $objectif->setVeterinary($veto5);
        $objectif->setProduct($produit2);
        $objectif->setAmount(1600);
        $objectif->setYear($anneeCourante-1);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto5);
        $objectif->setProduct($produit2);
        $objectif->setAmount(1500);
        $objectif->setYear($anneeCourante-2);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto5);
        $objectif->setProduct($produit3);
        $objectif->setAmount(520);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto5);
        $objectif->setProduct($produit5);
        $objectif->setAmount(1000);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto5);
        $objectif->setProduct($produit7);
        $objectif->setAmount(300);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto5);
        $objectif->setProduct($produit8);
        $objectif->setAmount(200);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto6);
        $objectif->setProduct($produit1);
        $objectif->setAmount(350);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto6);
        $objectif->setProduct($produit7);
        $objectif->setAmount(700);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto6);
        $objectif->setProduct($produit7);
        $objectif->setAmount(650);
        $objectif->setYear($anneeCourante-1);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto6);
        $objectif->setProduct($produit7);
        $objectif->setAmount(600);
        $objectif->setYear($anneeCourante-2);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto6);
        $objectif->setProduct($produit3);
        $objectif->setAmount(200);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        
        $objectif = new Goal();
        $objectif->setVeterinary($veto6);
        $objectif->setProduct($produit8);
        $objectif->setAmount(400);
        $objectif->setYear($anneeCourante);
        $manager->persist($objectif);
        //endregion

        //region Les suivis
        $suivi = new FollowUp();
        $suivi->setContactName('Mme Lasseau');
        $suivi->setComment('Les ventes de colliers Seresto pour les chiens ont explosé.' . "\r\n" . 'En rupture fiprospot chat.');
        $suivi->setCallDate($djourMoins30jours);
        $suivi->setVeterinary($veto1);
        $manager->persist($suivi);

        $suivi = new FollowUp();
        $suivi->setContactName('Mme Lasseau');
        $suivi->setComment('Prévoir un rendez-vous pour présenter la nouvelle gamme Dermoscent.');
        $suivi->setCallDate($djourMoins20jours);
        $suivi->setVeterinary($veto1);
        $manager->persist($suivi);

        $suivi = new FollowUp();
        $suivi->setContactName('Mme Desguerres');
        $suivi->setComment('Stocks en baisse sur l\'\'ensemble des produits. Prévoir une visite très rapidement pour présentation nouvelles gamme avant réapprovisionnement');
        $suivi->setCallDate($djourMoins5jours);
        $suivi->setVeterinary($veto1);
        $manager->persist($suivi);

        $suivi = new FollowUp();
        $suivi->setContactName('Mme Lasseau');
        $suivi->setComment('Réception des nouveaux produits effectuée. A rappeler dans 2 semaines.');
        $suivi->setCallDate(new \Datetime());
        $suivi->setVeterinary($veto1);
        $manager->persist($suivi);

        //*********************************************

        $suivi = new FollowUp();
        $suivi->setContactName('M. Renoux Perceval');
        $suivi->setComment('Première prise de contact. Un peu réticent.' . "\r\n" . 'Rendez-vous à prévoir');
        $suivi->setCallDate($djourMoins15jours);
        $suivi->setVeterinary($veto2);
        $manager->persist($suivi);

        $suivi = new FollowUp();
        $suivi->setContactName('M. Renoux Perceval');
        $suivi->setComment('Première prise de contact. Un peu réticent.' . "\r\n" . 'Rendez-vous à prévoir');
        $suivi->setCallDate(new \Datetime());
        $suivi->setVeterinary($veto2);
        $manager->persist($suivi);

        //*********************************************

        $suivi = new FollowUp();
        $suivi->setContactName('Mr Dupont Jean-Pierre');
        $suivi->setComment('Bonnes ventes sur le produit Feliway diffuseur.' . "\r\n" . 'Souhaite un complément d\'\'infos sur la gamme Dermoscent.');
        $suivi->setCallDate($djourMoins20jours);
        $suivi->setVeterinary($veto3);
        $manager->persist($suivi);

        $suivi = new FollowUp();
        $suivi->setContactName('Mr Dupont Jean-Pierre');
        $suivi->setComment('La gamme dermoscent marche plutôt bien.');
        $suivi->setCallDate($djourMoins15jours);
        $suivi->setVeterinary($veto3);
        $manager->persist($suivi);

        $suivi = new FollowUp();
        $suivi->setContactName('Mr Dupont Jean-Pierre');
        $suivi->setComment('Stocks en baisse sur l\'\'ensemble des produits. Prévoir une visite très rapidement pour présentation nouvelles gammes avant réapprovisionnement');
        $suivi->setCallDate(new \Datetime());
        $suivi->setVeterinary($veto3);
        $manager->persist($suivi);

        //*********************************************

        $suivi = new FollowUp();
        $suivi->setContactName('Mlle Pierval Magalie');
        $suivi->setComment('Première prise de contact. Bonne approche.' . "\r\n" . 'Rendez-vous à prévoir');
        $suivi->setCallDate($djourMoins15jours);
        $suivi->setVeterinary($veto4);
        $manager->persist($suivi);

        $suivi = new FollowUp();
        $suivi->setContactName('Mlle Pierval Magalie');
        $suivi->setComment('Les produits de la gamme Seresto marchent plutôt bien. Il faudrait étendre la gamme aux chats');
        $suivi->setCallDate(new \Datetime());
        $suivi->setVeterinary($veto4);
        $manager->persist($suivi);

        //*********************************************

        $suivi = new FollowUp();
        $suivi->setContactName('Mme Donicar Liliane');
        $suivi->setComment('Première prise de contact. Bonne approche.' . "\r\n" . 'Rendez-vous à prévoir');
        $suivi->setCallDate($djourMoins5jours);
        $suivi->setVeterinary($veto5);
        $manager->persist($suivi);

        //endregion

        //region Les utilisateurs

        $utilisateur1 = new User();
        $utilisateur1->setUsername('constantin');
        $utilisateur1->setRoles(['ROLE_USER']);
        $hashedPassword1 = $this->passwordHasher->hashPassword($utilisateur1, 'azerty');
        $utilisateur1->setPassword($hashedPassword1);
        $manager->persist($utilisateur1);

        $utilisateur2 = new User();
        $utilisateur2->setUsername('michael');
        $utilisateur2->setRoles(['ROLE_ADMIN']);
        $hashedPassword2 = $this->passwordHasher->hashPassword($utilisateur2, 'azerty');
        $utilisateur2->setPassword($hashedPassword2);
        $manager->persist($utilisateur2);

        $utilisateur3 = new User();
        $utilisateur3->setUsername('nicolas');
        $utilisateur3->setRoles(['ROLE_MANAGER']);
        $hashedPassword3 = $this->passwordHasher->hashPassword($utilisateur3, 'azerty');
        $utilisateur3->setPassword($hashedPassword3);
        $manager->persist($utilisateur3);

        // endregion


        $manager->flush();
    }
}

