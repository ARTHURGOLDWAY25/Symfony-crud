<?php

namespace App\Controller;

use App\Entity\Users; 
use App\Form\UserAuthFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserLoginController extends AbstractController
{
    public function login(AuthenticationUtils $authenticationUtils, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
    
        // Create and handle the form
        $form = $this->createForm(UserAuthFormType::class);
        $form->handleRequest($request);
    
        // Process form if submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $email = $data->getEmail();
            $password = $data->getPassword();

            // Log the request data to verify that email is being passed correctly
            dump($request->request->all());

            // Retrieve the user from the database
            $user = $entityManager->getRepository(Users::class)->findOneBy(['email' => $email]);

            if ($user) {
                // Check if the password is valid
                if ($passwordHasher->isPasswordValid($user, $password)) {
                    return $this->redirectToRoute('app_stock_management_index');
                }
    
                // Password mismatch feedback
                $this->addFlash('error', 'Invalid password.');
            } else {
                // User not found feedback
                $this->addFlash('error', 'User not found.');
            }
        }
    
        // Render the login page with the form and any errors
        return $this->render('user_login/index.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
