<?php

namespace Authentication\Form;

use Zend\Filter;
use Zend\Validator;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;

/**
 * Class AuthenticationForm
 * @package Authentication\Form
 */
class AuthenticationForm extends Form
{
    /**
     * AuthenticationForm constructor.
     */
    public function __construct()
    {
        parent::__construct( 'login-form' );

        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    private function addElements()
    {
        // Add "email" field
        $this->add([
            'name' 		 => 'email',
            'type' 		 => Element\Email::class,
            'options'    => [
                'label' => 'Email Adress:',
            ],
            'attributes' => [
                'class' 	  => 'form-control input-sm',
                'id' 		  => 'email',
                'aria-describedby' => "EmailhelpBlock",
                'placeholder' => 'email@example.com',
                'required' 	  => true,
                'autofocus'   => true,
            ],
        ]);

        // Add "password" field
        $this->add([
            'name' 		 => 'password',
            'type' 		 => Element\Password::class,
            'options'    => [
                'label' => 'Password:',
            ],
            'attributes' => [
                'class' 	  => 'form-control input-sm',
                'id' 		  => 'password',
                'placeholder' => '*******',
                'required' 	  => true,
            ],
        ]);

        // Add "remember-me" field
        $this->add([
            'name' 		 => 'remember-me',
            'type' 		 => Element\Checkbox::class,
            'attributes' => [
                'id' => 'remember-me',
            ],
        ]);

        // Add "scrf" field
        $this->add([
            'name' 		   => 'csrf',
            'type' 		   => Element\Csrf::class,
            'csrf_options' => [
                'timeout' => 600,
            ],
        ]);

        // Add "redirect-url" field
        $this->add([
            'name' => 'redirect-url',
            'type' => Element\Hidden::class,
        ]);

        // Add "submit" field button
        $this->add([
            'name' 		 => 'submit',
            'type' 		 => Element\Submit::class,
            'attributes' => [
                'class' => 'btn btn-primary btn-block',
                'id' 	=> 'submit',
                'value' => 'Login',
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter()
    {
        $filter = new InputFilter();
        $this->setInputFilter($filter);

        // Add filter for "email" field
        $filter->add([
            'name'		 => 'email',
            'required'	 => true,
            'filters'	 => [
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                ['name' => Validator\EmailAddress::class],
            ],
        ]);

        // Add filter for "password" field
        $filter->add([
            'name'		 => 'password',
            'required'	 => true,
            'filters'	 => [
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => Validator\StringLength::class,
                    'options' => ['min' => 5, 'max' => 50]
                ],
            ],
        ]);

        // Add filter for "remember-me" field
        $filter->add([
            'name'		 => 'remember-me',
            'required'	 => true,
            'filters'	 => [],
            'validators' => [
                [
                    'name'    => Validator\InArray::class,
                    'options' => [
                        'haystack' => [0, 1],
                    ]
                ],
            ],
        ]);

        // Add filter for "redirect-url" field
        $filter->add([
            'name'		 => 'redirect-url',
            'required'   => false,
            'filters'	 => [
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name'	  => Validator\StringLength::class,
                    'options' => ['min' => 0, 'max' => 2000],
                ],
            ],
        ]);
    }
}