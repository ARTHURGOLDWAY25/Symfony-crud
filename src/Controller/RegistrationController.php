<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class RegistrationController extends AbstractController
{
    
 
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check if the email already exists
            $existingUser = $entityManager->getRepository(Users::class)->findOneBy(['email' => $user->getEmail()]);

            if ($existingUser) {
                $this->addFlash('error', 'User email already exists.');
                return $this->redirectToRoute('app_registration');
            }

            // Hash the password and set it on the user entity
            $plainPassword = $form->get('password')->getData();
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            // Set default role if none provided
            $role = $form->get('roles')->getData();
            if (!$role) {
                $role = ['ROLE_USER']; // Default role is 'USER'
            } elseif (!is_array($role)) {
                $role = [$role];
            }
            $user->setRoles($role);

            // Persist the new user entity
            $entityManager->persist($user);
            $entityManager->flush();

            // Success flash message
            $this->addFlash('success', 'User successfully created');

            // Redirect to login page after successful registration
            return $this->redirectToRoute('app_user_login');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}


