<?php


namespace ZPB\AdminBundle\Validator\Constraints;



use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class Password extends Constraint
{
    public $message = 'Le mot de passe fourni est incorrect';
    public $minLen = 'Le mot de passe doit contenir au moins %d caractères';
    public $hasNum = 'Le mot de passe doit contenir au moins un chiffre.';
    public $hasLower = 'Le mot de passe doit contenir au moins une lettre minuscule.';
    public $hasUpper = 'Le mot de passe doit contenir au moins une lettre majuscule.';

    public function validatedBy()
    {

        return 'password_validator';
    }
}
