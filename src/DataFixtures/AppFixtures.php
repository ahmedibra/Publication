<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AppFixtures extends Fixture
{  
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
    $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
        {
        $user = new User();
        $user->setFirstName("faouzi");
        $user->setLastName("ben chabaane");
        $user->setEmail('cabinet.fbc@gnet.tn');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword($user,'nouretyass2008'));
        $manager->persist($user);
        $manager->flush();
        }
    }
