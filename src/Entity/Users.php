<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Correct single email definition
    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: false)]
    #[Assert\NotNull(message: "Email cannot be null.")]
    #[Assert\Email(message: "Invalid email format.")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    // Getter for id
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter for email
    public function getEmail(): ?string
    {
        return $this->email;
    }

    // Setter for email
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    // Getter for password
    public function getPassword(): ?string
    {
        return $this->password;
    }

    // Setter for password
    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    // UserInterface method: returns the email as the identifier
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    // Getter for roles
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER'; // Ensure every user has at least the ROLE_USER
        return array_unique($roles);
    }

    // Setter for roles
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    // Empty method for salt (not needed for modern hashing)
    public function getSalt()
    {
        // Not needed with modern password hashing
    }

    // Method to erase credentials (if needed)
    public function eraseCredentials()
    {
        // Clear sensitive data if necessary
    }

    // Alias for getUserIdentifier
    public function getUsername(): string
    {
        return $this->email;
    }
}


